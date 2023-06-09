<?php

namespace App\Providers;

use App\Models\Site_settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function($view){
            $view->with('settings', Site_settings::where('id', 1)->first());
        });
    }
}
