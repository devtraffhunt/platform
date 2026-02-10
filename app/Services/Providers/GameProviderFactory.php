<?php

namespace App\Services\Providers;

use App\Models\Game;
use App\Services\Providers\Contracts\GameProviderInterface;

class GameProviderFactory
{
    public function __construct(
        protected SlotMobuleService $slotMobuleService,
        protected InOutService $inOutService
    ) {}

    public function make(Game $game): GameProviderInterface
    {
        $key = $game->providerRelation->config_name
            ?? throw new \RuntimeException('Provider relation not loaded');

        return match ($key) {
            'inout'  => $this->inOutService,
            default  => $this->slotMobuleService,
        };
    }
}
