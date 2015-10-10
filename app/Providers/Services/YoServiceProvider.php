<?php
namespace App\Providers\Services;

use Illuminate\Support\ServiceProvider;
use App\Services\YoService;

class YoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Interfaces\Services\YoServiceInterface', function($app) {
            return new YoService();
        });
    }
}