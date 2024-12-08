<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetLeadStatusesService
{
    public function __construct(private readonly FormatApiDateStringService $formatApiDateStringService)
    {
    }

    public function execute(Request $request): array
    {
        $filters = $request->only(['limit', 'page']);
        $filters += [
            'date_from' => $this->formatApiDateStringService->formatToDateTimeString($request->get('date_from', '-30 days')),
            'date_to' => $this->formatApiDateStringService->formatToDateTimeString($request->get('date_to', '')),
        ];

        $response = Http::withHeaders([
            'token' => config('services.api.token'),
        ])->post(config('services.api.base_url') . '/getstatuses', $filters);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch lead statuses: ' . $response->body());
        }

        return $response->json();
    }
}
