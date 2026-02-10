<?php

namespace App\Services\Providers\Contracts;

use App\Models\{Game, User};

interface GameProviderInterface
{
    public function getFrameUrl(Game $game, string $type, ?User $user = null): string;
}
