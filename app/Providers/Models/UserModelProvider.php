<?php
namespace App\Providers\Models;

use Illuminate\Support\ServiceProvider;
use App\Models\UserModel;

class UserModelProvider extends ServiceProvider
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
        $this->app->bind('App\Interfaces\Models\UserModel', function($app) {
            return new UserModel();
        });
    }
}
