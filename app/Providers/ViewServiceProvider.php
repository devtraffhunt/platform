<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use App\Http\View\Composers\LayoutComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Подключаем композер ко всем шаблонам layouts/*
        $this->app['view']->composer('layouts.*', LayoutComposer::class);
    }

    public function register(): void {}
}
