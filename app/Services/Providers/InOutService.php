<?php

namespace App\Services\Providers;

use Illuminate\Support\Facades\Http;
use RuntimeException;
use App\Services\UserService;
use App\Services\Providers\Contracts\GameProviderInterface;
use App\Models\{Game, User};

class InOutService implements GameProviderInterface
{
    protected int $operatorId;
    protected string $secret;
    protected string $domain;
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->operatorId = (int) env('INOUT_OPERATOR_ID');
        $this->secret    = env('INOUT_KEY');
        $this->domain    = env('INOUT_DOMAIN');

        if (!$this->operatorId || !$this->secret || !$this->domain) {
            throw new RuntimeException('INOUT env config is missing');
        }
    }

    public function getFrameUrl(Game $game, string $type, ?User $user = null): string
    {
        if (!$user) {
            throw new RuntimeException('User required for InOut');
        }

        $iframe = $this->getIframe(
            $game->game_key,
            $type !== 'real',
            $user
        );

        if (!$iframe) {
            throw new RuntimeException('InOut iframe not returned');
        }

        return $iframe;
    }

    protected function makeToken(int $userId): string
    {
        return md5("{" . $userId . ":" . $this->operatorId . ":" . $this->secret . "}");
    }

    protected function getIframe(string $gameKey, bool $isDemo, User $user): ?string
    {
        $token = $this->makeToken($user->id);

        $user->token = $token;
        $user->save();

        $response = Http::timeout(10)->post(
            'https://' . $this->domain . '/api/auth',
            [
                'operator'   => (string) $this->operatorId,
                'auth_token' => $token,
                'currency'   => 'UZS',
                'isDemo'     => $isDemo ? 1 : 0,
                'lang'       => 'uz',
                'game_mode'  => (string) $gameKey,
                'user_id'    => (string) $user->id,
            ]
        );

        return $response->successful()
            ? ($response['iframe_url'] ?? null)
            : null;
    }

    public function balance($params): array
    {
        $user = $this->userService->balance($params['token']);

        return [
            'balance'  => $user['balance'],
            'currency' => $user['currency'],
            'user_id' => $user['id'],
        ];
    }


    public function debit(array $data): array
    {
        $response = Http::timeout(10)->post(
            "https://{$this->domain}/api/debit",
            [
                'operatorId' => $this->operatorId,
                'userId'     => $data['userId'],
                'token'      => $data['token'],
                'amount'     => $data['amount'],
                'trx_id'     => $data['trx_id'] ?? null,
            ]
        );

        if (!$response->successful()) {
            throw new RuntimeException('InOut debit request failed');
        }

        return [
            'balance' => (float) ($response['balance'] ?? 0),
            'trx_id'  => $response['trx_id'] ?? null,
        ];
    }

    public function credit(array $data): array
    {
        $response = Http::timeout(10)->post(
            "https://{$this->domain}/api/credit",
            [
                'operatorId' => $this->operatorId,
                'userId'     => $data['userId'],
                'token'      => $data['token'],
                'amount'     => $data['amount'],
                'trx_id'     => $data['trx_id'] ?? null,
            ]
        );

        if (!$response->successful()) {
            throw new RuntimeException('InOut credit request failed');
        }

        return [
            'balance' => (float) ($response['balance'] ?? 0),
            'trx_id'  => $response['trx_id'] ?? null,
        ];
    }

    public function cancel(array $data): array
    {
        $response = Http::timeout(10)->post(
            "https://{$this->domain}/api/cancel",
            [
                'operatorId' => $this->operatorId,
                'userId'     => $data['userId'],
                'token'      => $data['token'],
                'amount'     => $data['amount'],
                'trx_id'     => $data['trx_id'],
            ]
        );

        if (!$response->successful()) {
            throw new RuntimeException('InOut cancel request failed');
        }

        return [
            'balance' => (float) ($response['balance'] ?? 0),
            'trx_id'  => $response['trx_id'] ?? null,
        ];
    }
}
