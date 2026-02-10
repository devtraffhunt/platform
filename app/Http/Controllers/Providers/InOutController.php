<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Providers\InOutService;
use Illuminate\Http\JsonResponse;

class InOutController extends Controller
{
    public function __construct(
        protected InOutService $service
    ) {}

    public function balance(Request $request): JsonResponse
    {

        $data = $request->validate([
            'userId'     => 'required|integer',
            'token'      => 'required|string',
            'operatorId' => 'required|integer',
        ]);

        try {
            return response()->json([
                'success' => true,
                'data' => $this->service->balance($data),
            ]);
        } catch (\Throwable $e) {
            return $this->error($e);
        }
    }

    public function debit(Request $request): JsonResponse
    {
        $data = $request->validate([
            'userId'     => 'required|integer',
            'token'      => 'required|string',
            'operatorId' => 'required|integer',
            'amount'     => 'required|numeric|min:0.01',
        ]);

        try {
            return response()->json([
                'success' => true,
                'data' => $this->service->debit($data),
            ]);
        } catch (\Throwable $e) {
            return $this->error($e);
        }
    }

    public function credit(Request $request): JsonResponse
    {
        $data = $request->validate([
            'userId'     => 'required|integer',
            'token'      => 'required|string',
            'operatorId' => 'required|integer',
            'amount'     => 'required|numeric|min:0.01',
        ]);

        try {
            return response()->json([
                'success' => true,
                'data' => $this->service->credit($data),
            ]);
        } catch (\Throwable $e) {
            return $this->error($e);
        }
    }

    private function error(\Throwable $e): JsonResponse
    {
        \Log::error('InOut error', [
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 400);
    }
}
