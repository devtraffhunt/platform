<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleFromBrowser
{
    public function handle(Request $request, Closure $next)
    {
        // поддерживаем только нужные языки
        $availableLocales = ['uz'];
        $fallback = config('app.fallback_locale', 'uz');

        // если в сессии есть язык
        $sessionLocale = session('locale');

        if ($sessionLocale) {
            // если допустимый язык — используем
            if (in_array($sessionLocale, $availableLocales)) {
                App::setLocale($sessionLocale);
                return $next($request);
            } else {
                // если недопустимый (например, "ru") — сбрасываем
                session()->forget('locale');
            }
        }

        // определяем по браузеру
        $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE') ?? '', 0, 2);
        $locale = in_array($browserLocale, $availableLocales) ? $browserLocale : $fallback;

        App::setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}
