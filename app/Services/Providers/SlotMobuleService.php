<?php

namespace App\Services\Providers;

use App\Services\UserService;
use App\Traits\AmountConversionTrait;
use App\Services\Providers\Contracts\GameProviderInterface;
use App\Models\{Game, User};
use App\Services\GameService;
use Exception;

class SlotMobuleService implements GameProviderInterface
{
    use AmountConversionTrait;

    public function __construct(
        protected UserService $userService
    ) {}

    public function getFrameUrl(Game $game, string $type, ?User $user = null): string
    {
        if ($type === 'real') {
            if (!$user) {
                throw new \RuntimeException('User is required for real mode');
            }

            if (!$user->token) {
                $user->token = \Str::random(12);
                $user->save();
            }
        }

        $params = http_build_query([
            'partner.alias'   => 'partner1497',
            'partner.session' => $type === 'real' ? $user->token : 'demo-token',
            'game.provider'   => $game->provider,
            'game.alias'      => $game->alias,
            'lang'            => 'en',
            'lobby_url'       => 'https://laravel12.upwin.co/',
            'currency'        => 'INR',
            'mobile'          => 'false',
        ]);

        $endpoint = $type === 'real' ? 'games.start' : 'games.startDemo';

        return "https://partners.casinomobule.com/{$endpoint}?{$params}";
    }

    /* -------- CALLBACK METHODS -------- */

    public function checkSession(string $token, string $currency): array
    {
        $user = $this->userService->getUserByToken($token);

        if ($user->currency !== $currency) {
            throw new Exception('Invalid currency');
        }

        return [
            'id_player' => $user->id,
            'id_group'  => 'default',
            'token'     => $user->token,
            'currency'  => $user->currency,
            'balance'   => $this->convertToCents($user->balance_real),
        ];
    }

    public function checkBalance(string $token, string $currency): array
    {
        $data = $this->userService->balance($token);

        if ($data['currency'] !== $currency) {
            throw new Exception('Invalid currency');
        }

        return [
            'id_player' => $data['id'],
            'id_group'  => 'default',
            'token'     => $data['token'],
            'currency'  => $data['currency'],
            'balance'   => $this->convertToCents($data['balance']),
        ];
    }

    public function withdrawBet($token, $gameId, $amountCents, $currency, $trxId, $payload): array
    {
        $amount = $this->convertFromCents($amountCents);

        $gameService = app(GameService::class);
        $data = $gameService->debit($token, $gameId, $amount, $currency, $trxId, $payload);

        return [
            'id_player' => $data['user_id'],
            'id_group'  => 'default',
            'token'     => $data['user_token'],
            'currency'  => $data['currency'],
            'balance'   => $this->convertToCents($data['balance']),
        ];
    }

    public function depositWin($token, $gameId, $amountCents, $currency, $trxId, $payload): array
    {
        $amount = $this->convertFromCents($amountCents);

        if ($amount == 0) {
            return $this->checkBalance($token, $currency);
        }

        $gameService = app(GameService::class);
        $data = $gameService->credit($token, $gameId, $amount, $currency, $trxId, $payload);

        return [
            'id_player' => $data['user_id'],
            'id_group'  => 'default',
            'token'     => $data['user_token'],
            'currency'  => $data['currency'],
            'balance'   => $this->convertToCents($data['balance']),
        ];
    }
}
