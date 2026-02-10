<?php

namespace App\Services;

use App\Models\{User, GameTransaction, Game};
use App\Services\UserService;
use App\DTO\Games\GamesListDTO;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Services\Providers\SlotMobuleService;
use Illuminate\Support\Facades\DB;
use App\Enums\GameTransactionType;
use App\Services\Providers\GameProviderFactory;


class GameService
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function getGamesList(GamesListDTO $dto): array
    {
        $query = Game::query()
            ->where('is_show', true)
            ->orderByDesc('priority')
            ->orderBy('id')
            ->with(['providerRelation:id,config_name,name,icon']);

        if (!empty($dto->provider_id)) {
            $query->where('provider', $dto->provider_id);
        }

        if (!empty($dto->search)) {
            $query->where('title', 'like', "%{$dto->search}%");
        }

        $games = $query->paginate(60);

        $games->getCollection()->transform(function ($game) {
            return [
                'id'         => $game->game_key,
                'title'      => $game->title,
                'banner_img' => $game->banner_img,
                'provider'   => [
                    'name' => $game->providerRelation->name ?? '',
                    'icon' => $game->providerRelation->icon ?? ''
                ],
            ];
        });

        return [
            'slots' => $games->items(),
            'pagination' => [
                'current_page' => $games->currentPage(),
                'last_page'    => $games->lastPage(),
                'per_page'     => $games->perPage(),
            ]
        ];
    }


    public function getGameByKey(string $gameKey): Game
    {
        return Game::with('providerRelation:id,config_name')
            ->where('game_key', $gameKey)
            ->firstOrFail();
    }

    public function getGameUrl(Game $game, string $type, ?User $user = null): string
    {
        $provider = app(GameProviderFactory::class)->make($game);
        return $provider->getFrameUrl($game, $type, $user);
    }


    public function debit(string $token, string $gameKey, float $amount, string $currency, string $external_id, array $payload): array
    {
        return DB::transaction(function () use ($token, $gameKey, $amount, $currency, $external_id, $payload) {
            $user = $this->userService->getUserByToken($token);
            $game = $this->getGameByKey($gameKey);

            $balanceBefore = $user->balance_real;

            $updatedBalance = $this->userService->debit($token, $amount, $currency);
            $balanceAfter = $updatedBalance['balance'];

            GameTransaction::create([
                'user_id'          => $user->id,
                'game_id'          => $game->id,
                'external_id'       => $external_id,
                'provider_id'      => $game->provider_id,
                'transaction_type' => GameTransactionType::BET,
                'amount'           => $amount,
                'balance_before'   => $balanceBefore,
                'balance_after'    => $balanceAfter,
                'currency'         => $currency,
                'payload'         => $payload,
                'created'          => now(),
            ]);

            $this->userService->updateUserGameStats(
                $user,
                $amount,
                $currency,
                GameTransactionType::BET
            );

            return [
                'user_id'        => $user->id,
                'user_token'     => $user->token,
                'currency'       => $user->currency,
                'balance'        => $balanceAfter,
                'balance_before' => $balanceBefore,
                'balance_after'  => $balanceAfter,
                'game_id'        => $game->id,
                'game_key'       => $game->key,
            ];
        });
    }


    public function credit(string $token, string $gameKey, float $amount, string $currency, string $external_id, array $payload): array
    {
        return DB::transaction(function () use ($token, $gameKey, $amount, $currency, $external_id, $payload) {
            $user = $this->userService->getUserByToken($token);
            $game = $this->getGameByKey($gameKey);

            $balanceBefore = $user->balance_real;

            $updatedBalance = $this->userService->credit($token, $amount, $currency);
            $balanceAfter = $updatedBalance['balance'];

            GameTransaction::create([
                'user_id'          => $user->id,
                'game_id'          => $game->id,
                'external_id'       => $external_id,
                'provider_id'      => $game->provider_id,
                'transaction_type' => GameTransactionType::WIN,
                'amount'           => $amount,
                'balance_before'   => $balanceBefore,
                'balance_after'    => $balanceAfter,
                'currency'         => $currency,
                'payload'         => $payload,
                'created'          => now(),
            ]);

            $this->userService->updateUserGameStats(
                $user,
                $amount,
                $currency,
                GameTransactionType::WIN
            );

            return [
                'user_id'        => $user->id,
                'user_token'     => $user->token,
                'currency'       => $user->currency,
                'balance'        => $balanceAfter,
                'balance_before' => $balanceBefore,
                'balance_after'  => $balanceAfter,
                'game_id'        => $game->id,
                'game_key'       => $game->game_key,
            ];
        });
    }


    public function refund(string $token, string $gameKey, float $amount, string $currency, string $external_id,  array $payload): array
    {
        return DB::transaction(function () use ($token, $gameKey, $amount, $currency, $external_id, $payload) {
            $user = $this->userService->getUserByToken($token);
            $game = $this->getGameByKey($gameKey);

            $balanceBefore = $user->balance_real;

            $updatedBalance = $this->userService->debit($token, $amount, $currency);
            $balanceAfter = $updatedBalance['balance'];

            GameTransaction::create([
                'user_id'          => $user->id,
                'game_id'          => $game->id,
                'external_id'       => $external_id,
                'provider_id'      => $game->provider_id,
                'transaction_type' => GameTransactionType::REFUND,
                'amount'           => $amount,
                'balance_before'   => $balanceBefore,
                'balance_after'    => $balanceAfter,
                'currency'         => $currency,
                'payload'         => $payload,
                'created'          => now(),
            ]);

            $this->userService->updateUserGameStats(
                $user,
                $amount,
                $currency,
                GameTransactionType::REFUND
            );

            return [
                'user_id'        => $user->id,
                'user_token'     => $user->token,
                'currency'       => $user->currency,
                'balance'        => $balanceAfter,
                'balance_before' => $balanceBefore,
                'balance_after'  => $balanceAfter,
                'game_id'        => $game->id,
                'game_key'       => $game->game_key,
            ];
        });
    }
}
