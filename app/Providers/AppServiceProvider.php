<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

   public function boot(): void
{
    URL::forceScheme('https');

    View::composer(['layouts.app', 'home'], function ($view) {
        $view->with('site', Setting::pairs());
    });
}
}
