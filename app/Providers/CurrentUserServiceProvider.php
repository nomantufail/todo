<?php

namespace App\Providers;

use App\CurrentUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class CurrentUserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\CurrentUser', function ($app) {
            $current_user = new CurrentUser(Auth::user());
            return $current_user;
        });
    }
}
