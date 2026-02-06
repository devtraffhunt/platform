<?php

namespace App\Services;

use App\Models\{User, Game};
use App\Enums\UserType;
use Exception;
use App\Enums\GameTransactionType;

class UserService
{
    //get user from token
    public function getUserByToken(string $token): User
    {
        $user = User::where('token', $token)->first();

        if (!$user) {
            throw new Exception('Invalid session token');
        }

        return $user;
    }

    //get user balance
    public function balance(string $token): array
    {
        $user = $this->getUserByToken($token);

        return $this->formatUserBalance($user);
    }

    private function formatUserBalance(User $user): array
    {
        return [
            'id' => $user->id,
            'token' => $user->token,
            'currency' => $user->currency,
            'balance' => $user->balance_real
        ];
    }

    //top up balance
    public function credit(string $token, float $amount, string $currency): array
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException("Amount must be positive.");
        }

        $user = $this->getUserByToken($token);

        if ($user->currency !== $currency) {
            throw new \RuntimeException("Currency mismatch. Expected: {$user->currency}, Given: {$currency}");
        }

        $user->balance_real += $amount;
        $user->save();

        return $this->formatUserBalance($user);
    }


    //remove balance
    public function debit(string $token, float $amount, string $currency): array
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException("Amount must be positive.");
        }

        $user = $this->getUserByToken($token);

        if ($user->currency !== $currency) {
            throw new \RuntimeException("Currency mismatch. Expected: {$user->currency}, Given: $currency");
        }

        if ($user->balance_real < $amount) {
            throw new \RuntimeException("Insufficient real balance.");
        }

        $user->balance_real -= $amount;
        $user->save();

        return $this->formatUserBalance($user);
    }

    public function updateUserGameStats(User $user, float $amount, string $currency, GameTransactionType $type): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException("Amount must be positive.");
        }

        if ($user->currency !== $currency) {
            throw new \RuntimeException("Currency mismatch. Expected: {$user->currency}, Given: $currency");
        }

        match ($type) {
            GameTransactionType::BET => $this->applyBetStats($user, $amount),
            GameTransactionType::WIN => $this->applyWinStats($user, $amount),
            GameTransactionType::REFUND => $this->applyRefundStats($user, $amount),
        };

        $user->save();
    }

    private function applyBetStats(User $user, float $amount): void
    {
        $user->bets_counts += 1;
        $user->bets_amount += $amount;
        $user->last_bet_date = now();
    }

    private function applyWinStats(User $user, float $amount): void
    {
        $user->win_amount += $amount;
    }

    private function applyRefundStats(User $user, float $amount): void
    {
        $user->bets_amount = max(0, $user->bets_amount - $amount);
        $user->bets_counts = max(0, $user->bets_counts - 1);
    }
}
