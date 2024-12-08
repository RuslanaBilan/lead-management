<?php

namespace App\Services;
use Carbon\Carbon;

class FormatApiDateStringService
{
    public function formatToDateString(string $date): string
    {
        return Carbon::parse($date)->toDateString();
    }

    public function formatToDateTimeString(string $date): string
    {
        return Carbon::parse($date)->toDateTimeString();
    }
}
