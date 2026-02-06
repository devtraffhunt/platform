<?php

namespace App\Http\Controllers;

use App\DTO\Games\{GamesListDTO, GameShowDTO};
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class GameController extends Controller
{
    public function __construct(protected GameService $gameService) {}

    public function gameList(Request $request)
    {
        $dto = GamesListDTO::fromArray($request->all());
        $data = $this->gameService->getGamesList($dto);

        return response()->json([
            'success' => true,
            'message' => 'Games list fetched.',
            'data' => $data,
        ], 200);
    }

    public function gamePage(Request $request, string $game_key)
    {
        $request->merge(['game_key' => $game_key]);
        $request->validate(GameShowDTO::rules());

        $dto = GameShowDTO::fromArray([
            'game_key' => $request->game_key,
            'type' => $request->type,
        ]);

        $user = auth()->user();

        // Если пользователь не авторизован, но параметр type не передан — делаем редирект с ?type=demo
        if (!$user && $dto->type != 'demo') {
            return redirect()->route(Route::currentRouteName(), [
                'game_key' => $game_key,
                'type' => 'demo',
            ]);
        }

        try {
            $game = $this->gameService->getGameByKey($dto->game_key);
        } catch (\RuntimeException $e) {
            return view('game', [
                'title' => 'Game not found',
                'type' => '404',
                'is_demo' => false,
                'url' => null,
            ]);
        }

        $url = $this->gameService->getGameUrl($game, $dto->type, $user);

        return view('game', [
            'title' => $game->title,
            'type' => $dto->type,
            'is_demo' => $game->is_demo,
            'url' => $url,
        ]);
    }
}
