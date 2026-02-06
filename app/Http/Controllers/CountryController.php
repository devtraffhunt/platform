<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\CountryService;

class CountryController extends Controller
{
    public function __construct(protected CountryService $service) {}

    public function import(): JsonResponse
    {
        try {
            $this->service->importFromApi();

            return response()->json([
                'success' => true,
                'message' => 'Список стран успешно импортирован',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
