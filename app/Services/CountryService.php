<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CountryService
{
    protected string $endpoint = 'https://restcountries.com/v2/all';

    /**
     * Импортирует список стран из внешнего API.
     */
    public function importFromApi(): void
    {
        $response = Http::get($this->endpoint);

        if (!$response->ok()) {
            throw new \Exception('Ошибка при получении списка стран');
        }

        foreach ($response->json() as $item) {
            if (empty($item['alpha2Code'])) {
                continue;
            }

            $existing = Country::where('alpha2Code', strtolower($item['alpha2Code']))->first();

            $data = [
                'name'         => $item['name'] ?? '',
                'alpha2Code'   => strtolower($item['alpha2Code']),
                'alpha3Code'   => strtoupper($item['alpha3Code'] ?? ''),
                'region'       => $item['region'] ?? '',
                'native_name'  => $item['nativeName'] ?? '',
                'flag'         => $item['flag'] ?? '',
                'currency'     => $item['currencies'][0]['code'] ?? null,
                'calling_code' => $item['callingCodes'][0] ?? null,
                'is_available' => true,
            ];

            if (!$existing) {
                Country::create($data);
            } else {
                $diff = array_diff_assoc($data, $existing->only(array_keys($data)));
                if (!empty($diff)) {
                    $existing->update($data);
                }
            }
        }
    }

    /**
     * Определяет страну и валюту по IP-адресу.
     */
    public function detectByIp(string $ip): array
    {
        try {
            $geo = geoip($ip);

            if (!$geo || empty($geo->iso_code)) {
                return $this->getDefault();
            }

            $country = Country::where('alpha2Code', strtolower($geo->iso_code))->first();

            return [
                'country_id' => $country?->id,
                'currency'   => $country?->currency ?? 'USD',
            ];
        } catch (\Throwable $e) {
            Log::warning('GeoIP failed', [
                'ip'    => $ip,
                'error' => $e->getMessage(),
            ]);

            return $this->getDefault();
        }
    }

    /**
     * Значения по умолчанию при ошибке.
     */
    protected function getDefault(): array
    {
        return [
            'country_id' => null,
            'currency'   => 'USD',
        ];
    }
}
