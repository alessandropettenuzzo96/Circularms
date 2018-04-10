<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Navigable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.settings.routes', function ($view) {
            $view->with('routes', Navigable::all()->toArray());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
