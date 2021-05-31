<?php

namespace Rutatiina\Banking;

use Illuminate\Support\ServiceProvider;

class BankingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes/routes.php';
        include __DIR__.'/routes/api.php';

        $this->loadViewsFrom(__DIR__.'/resources/views/limitless', 'banking');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->make('Rutatiina\Banking\Http\Controllers\BankingController');
    }
}
