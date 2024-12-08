<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class LeadListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_from' => ['nullable', 'date', 'date_format:Y-m-d', function ($attribute, $value, $fail) {
                $dateFrom = Carbon::parse($value);
                $currentDate = Carbon::now();

                if ($dateFrom->diffInDays($currentDate) > 60) {
                    return $fail(__('The date_from cannot be more than 60 days ago.'));
                }
                if ($dateFrom->diffInDays($currentDate) < 0) {
                    return $fail(__('The date_from cannot be hither, then current date.'));
                }
            }],
            'date_to' => 'nullable|date|date_format:Y-m-d',
            'limit' => 'nullable|integer|min:1|max:500',
            'page' => 'nullable|string|max:15',
        ];
    }
}
