<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SoapClienteServiceProvider extends ServiceProvider
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
        \App::bind('recargas', function()
        {
            return new \App\Components\SoapController;
        });
    }
}
