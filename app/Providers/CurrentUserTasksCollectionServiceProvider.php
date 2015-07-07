<?php

namespace App\Providers;

use App\CurrentUserTasksCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class CurrentUserTasksCollectionServiceProvider extends ServiceProvider
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
        $this->app->singleton('App\CurrentUserTasksCollection', function ($app) {
            return new CurrentUserTasksCollection(Auth::user());
        });
    }
}
