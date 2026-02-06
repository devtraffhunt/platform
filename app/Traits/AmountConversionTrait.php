<?php

namespace App\Traits;

trait AmountConversionTrait
{
    public function convertToCents(float $amount): int
    {
        return (int) round($amount * 100);
    }

    public function convertFromCents(int $cents): float
    {
        return $cents / 100;
    }
}
