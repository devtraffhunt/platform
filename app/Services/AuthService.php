<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\{Registered, Login};
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use App\DTO\Auth\{RegisterQuickDTO, LoginEmailDTO, LoginPhoneDTO};
use App\Validators\DTOValidator;
use App\Enums\{UserType, OcType, DeviceType, RegistrationType};
use Detection\MobileDetect;
use App\Services\{CountryService, DomainService};

class AuthService
{
    public function __construct(
        protected CountryService $countryService,
        protected DomainService $domainService
    ) {}

    public function registerQuick(RegisterQuickDTO $dto): JsonResponse
    {
        DTOValidator::validate($dto);
        $request = request();

        $ip = $request->ip();
        $userAgent = $request->userAgent();
        $country = $this->countryService->detectByIp($ip);
        $domainInfo = $this->domainService->getByDomain($dto->domain);

        $user = User::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'type' => UserType::USER,
            'phone' => '91'.$dto->phone,
            'affiliate_id' => $dto->affiliate_id ?? $domainInfo?->affiliate_id,
            'telegram_id' => $dto->telegram_id,
            'avatar' => null,
            'registration_ip' => $ip,
            'registration_country_id' => $country['country_id'],
            'registration_user_agent' => $userAgent,
            'registration_oc' => $this->detectOS($userAgent),
            'registration_device_type' => $this->detectDeviceType($userAgent),
            'type_registration' => RegistrationType::QUICK,
            'registration_bonus_id' => $dto->bonus_id,
            'registration_game_id' => $dto->game_id,
            'registration_url' => $dto->url,
            'registration_domain_id' => $domainInfo?->id,
            'last_visit_date' => now(),
            'currency' => 'INR',
            'sub1' => $dto->sub1,
            'sub2' => $dto->sub2,
            'sub3' => $dto->sub3,
            'sub4' => $dto->sub4,
            'sub5' => $dto->sub5,
        ]);

        event(new Registered($user));

        // ✅ Залогиниваем пользователя через session guard
        Auth::login($user, true);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
        ]);
    }


    protected function detectDeviceType(string $agent): DeviceType
    {
        $detect = new MobileDetect();
        $detect->setUserAgent($agent);

        return match (true) {
            $detect->isTablet() => DeviceType::TABLET,
            $detect->isMobile() => DeviceType::MOBILE,
            str_contains($agent, 'Windows') || str_contains($agent, 'Macintosh') => DeviceType::DESKTOP,
            default => DeviceType::OTHER,
        };
    }


    protected function detectOS(string $userAgent): OcType
    {
        $detect = new MobileDetect();
        $detect->setUserAgent($userAgent);

        if ($detect->isiOS()) {
            return OcType::IOS;
        }

        if ($detect->isAndroidOS()) {
            return OcType::ANDROID;
        }

        if (stripos($userAgent, 'Win') !== false) {
            return OcType::WINDOWS;
        }

        if (stripos($userAgent, 'Mac') !== false) {
            return OcType::MACOS;
        }

        if (stripos($userAgent, 'Linux') !== false) {
            return OcType::LINUX;
        }

        return OcType::OTHER;
    }


    public function loginEmail(LoginEmailDTO $dto): string
    {
        DTOValidator::validate($dto); // если ты используешь свою кастомную DTO-валидацию

        $user = User::where('email', $dto->email)->first();

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password.']
            ])->status(401);
        }

        event(new Login('web', $user, false));

        // Логиним через Laravel session guard
        Auth::login($user, true);

        // Возвращаем токен для API-авторизации, если используется Sanctum
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function loginPhone(LoginPhoneDTO $dto): string
    {
        DTOValidator::validate($dto);

        $user = User::where('phone', '91'.$dto->phone)->first();

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['Invalid phone number or password.']
            ])->status(401);
        }

        event(new Login('web', $user, false));

        Auth::login($user, true);

        return $user->createToken('auth_token')->plainTextToken;
    }


    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
