<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\DTO\Auth\{RegisterQuickDTO, LoginEmailDTO, LoginPhoneDTO};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}



    public function registerQuick(Request $request)
    {
        
        $validated = $request->validate(RegisterQuickDTO::rules());

        $dto = RegisterQuickDTO::fromArray($validated);
        Log::info('registerQuick() DTO:', (array) $dto);

        $token = $this->authService->registerQuick($dto);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
            'data' => [
                'token' => $token,
            ]
        ], 201);
    }


    public function loginEmail(Request $request)
    {
        $validated = $request->validate(LoginEmailDTO::rules());

        $dto = LoginEmailDTO::fromArray($validated);

        $token = $this->authService->loginEmail($dto);

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'token' => $token,
            ]
        ], 200);
    }

    public function loginPhone(Request $request)
    {
        $validated = $request->validate(LoginPhoneDTO::rules());

        $dto = LoginPhoneDTO::fromArray($validated);

        $token = $this->authService->loginPhone($dto);

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'token' => $token,
            ]
        ], 200);
    }

    public function logout()
    {
        $this->authService->logout();

        // Для веба сделай редирект
        return redirect('/');
    }
}
