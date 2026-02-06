<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class LayoutComposer
{
    public function compose(View $view): void
    {
        $setting = Setting::first(); // Или кэшируй здесь

        $view->with([
            'setting' => $setting,
            'user' => Auth::user(),
        ]);
    }
}
