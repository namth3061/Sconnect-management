<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!config('auth.login_via_kong')) {
            view()->composer('livewire.components.layouts.app', function ($view) {
                $view->with('authUser', json_decode($_COOKIE['user']));
            });
        }
    }
}
