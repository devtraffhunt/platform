<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Providers\SlotMobuleService;
use Illuminate\Http\JsonResponse;

class SlotMobuleController extends Controller
{
    public function __construct(
        protected SlotMobuleService $slotMobuleService
    ) {}

    private function respond(int $status, string $method, array|string $data): JsonResponse
    {
        return response()->json([
            'status'  => $status,
            'method'  => $method,
            $status === 200 ? 'response' : 'message' => $data,
        ], $status);
    }


    public function callback(string $method, Request $request)
    {
        \Log::info('SlotMobule callback received', [
        'method' => $method,
        'ip' => $request->ip(),
        'headers' => $request->headers->all(),
        'payload' => $request->all(),
    ]);

        return match ($method) {
            'check.session'   => $this->checkSession($request),
            'check.balance'   => $this->checkBalance($request),
            'trx.cancel'      => $this->trxCancel($request),
            'trx.complete'    => $this->trxComplete($request),
            'withdraw.bet'    => $this->withdrawBet($request),
            'deposit.win'     => $this->depositWin($request),
            default           => response()->json(['status' => 400, 'error' => 'Unknown method']),
        };
    }

    public function checkSession(Request $request): JsonResponse
    {
        if (!$request->session) {
            return $this->respond(400, 'check.session', 'Session token is missing.');
        }

        try {
            $data = $this->slotMobuleService->checkSession($request->session, $request->currency);
            return $this->respond(200, 'check.session', $data);
        } catch (\Throwable $e) {
\Log::error("check.session error", [
    'message' => $e->getMessage(),
    'trace' => $e->getTraceAsString(),
    'payload' => $request->all(),
    'ip' => $request->ip(),
]);

            return $this->respond(404, 'check.session', $e->getMessage());
        }
    }


    public function checkBalance(Request $request): JsonResponse
    {
        if (!$request->session) {
            return $this->respond(400, 'check.balance', 'Session token is missing.');
        }

        try {
            $data = $this->slotMobuleService->checkBalance($request->session, $request->currency);
            return $this->respond(200, 'check.balance', $data);
        } catch (\Throwable $e) {

            \Log::error("check.balance error", [
    'message' => $e->getMessage(),
    'trace' => $e->getTraceAsString(),
    'payload' => $request->all(),
    'ip' => $request->ip(),
]);
            return $this->respond(404, 'check.balance', $e->getMessage());
        }
    }


    public function trxCancel(Request $request): JsonResponse
    {
        if (!$request->session) {
            return $this->respond(400, 'trx.cancel', 'Session token is missing.');
        }

        try {
            $gameId = $request->input('meta.tag.game_id');
            $data = $this->slotMobuleService->cancelTransaction($request->session, $gameId, $request->amount, $request->currency, $request->trx_id, $request->all());
            return $this->respond(200, 'trx.cancel', $data);
        } catch (\Throwable $e) {
            \Log::error("trx.cancel error", [
    'message' => $e->getMessage(),
    'trace' => $e->getTraceAsString(),
    'payload' => $request->all(),
    'ip' => $request->ip(),
]);
            return $this->respond(404, 'trx.cancel', $e->getMessage());
        }
    }

    public function withdrawBet(Request $request): JsonResponse
    {
        if (!$request->session || !$request->trx_id) {
            return $this->respond(400, 'withdraw.bet', 'Missing required parameters.');
        }

        try {
            $gameId = $request->input('meta.tag.game_id');
            $data = $this->slotMobuleService->withdrawBet(
                $request->session,
                $gameId,
                $request->amount,
                $request->currency,
                $request->trx_id,
                $request->all()
            );

            return $this->respond(200, 'withdraw.bet', $data);
        } catch (\Throwable $e) {
            \Log::error("withdraw.bet error", [
    'message' => $e->getMessage(),
    'trace' => $e->getTraceAsString(),
    'payload' => $request->all(),
    'ip' => $request->ip(),
]);
            return $this->respond(404, 'withdraw.bet', $e->getMessage());
        }
    }

    public function depositWin(Request $request): JsonResponse
    {
        if (!$request->session || !$request->trx_id) {
            return $this->respond(400, 'deposit.win', 'Missing required parameters.');
        }

        try {
            $gameId = $request->input('meta.tag.game_id');
            $data = $this->slotMobuleService->depositWin(
                $request->session,
                $gameId,
                $request->amount,
                $request->currency,
                $request->trx_id,
                $request->all()
            );

            return $this->respond(200, 'deposit.win', $data);
        } catch (\Throwable $e) {
            \Log::error("deposit.win error", [
    'message' => $e->getMessage(),
    'trace' => $e->getTraceAsString(),
    'payload' => $request->all(),
    'ip' => $request->ip(),
]);
            return $this->respond(404, 'deposit.win', $e->getMessage());
        }
    }
}
