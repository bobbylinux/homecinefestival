<?php

namespace App\Providers;

use App\Services\CicloService;
use Illuminate\Support\ServiceProvider;

class CicloServiceProvider extends ServiceProvider
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
        $this->app->bind(CicloService::class,function($app) {
            return new CicloService();
        });
    }
}
