<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddLeadService
{
    public function execute(Request $request): array
    {
        $data = array_merge($request->validated(), [
            'box_id' => config('services.api.box_id'),
            'offer_id' => config('services.api.offer_id'),
            'countryCode' => config('services.api.country_code'),
            'language' => config('services.api.language'),
            'password' => config('services.api.password'),
            'ip' => $request->ip(),
            'landingUrl' => url()->current(),
            ]);

        $response = Http::withHeaders([
            'token' => config('services.api.token'),
        ])->post(config('services.api.base_url') . '/addlead', $data);

        if (!$response->successful()) {
            throw new \Exception('Failed to send lead: ' . $response->body());
        }

        return $response->json();
    }
}
