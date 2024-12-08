<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadListRequest;
use App\Http\Requests\LeadStoreRequest;
use App\Services\AddLeadService;
use App\Services\FormatApiDateStringService;
use App\Services\GetLeadStatusesService;

class LeadController extends Controller
{
    public function __construct(
        private readonly AddLeadService $addLeadService,
        private readonly GetLeadStatusesService $getLeadStatusesService
    ) {
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(LeadStoreRequest $request)
    {
        $result = $this->addLeadService->execute($request);

        if (isset($result['status']) && $result['status'] === true) {
            return redirect()->route('leads.create')->with('success', 'Lead submitted successfully!');
        } else {
            return redirect()->route('leads.create')->withErrors($result['error'] ?? 'Unexpected error');
        }
    }

    public function index(LeadListRequest $request, FormatApiDateStringService $apiDateStringService)
    {
        $statuses = $this->getLeadStatusesService->execute($request);
        $dateFrom = $apiDateStringService->formatToDateString($statuses['date_from'] ?? '');
        $dateTo = $apiDateStringService->formatToDateString($statuses['date_to'] ?? '');
        $limit = $statuses['limit'] ?? 100;
        $page = $statuses['page'] ?? 0;
        $data = $statuses['data'] ?? [];

        return view('leads.index', compact(
            'dateFrom',
            'dateTo',
            'limit',
            'page',
            'data'
        ));
    }
}
