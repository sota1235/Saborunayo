<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * 通常の方法でサービスコンテナに突っ込む
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerAuthDrivers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* Services */
        $this->app->bind('\App\Interfaces\Services\GitHubServiceInterface', function ($app) {
            $goutte = $app->make('\Goutte\Client');
            return new \App\Services\GitHubService($goutte);
        });
        $this->app->bind('\App\Interfaces\Services\UserServiceInterface', function ($app) {
            $userModel       = $app->make('App\Interfaces\Models\UserModelInterface');
            $gitHubInfoModel = $app->make('App\Interfaces\Models\GitHubInfoModelInterface');
            return new \App\Services\UserService($userModel, $gitHubInfoModel);
        });
        $this->app->bind('\App\Interfaces\Services\YoServiceInterface', function ($app) {
            return new \App\Services\YoService();
        });
        /* Models */
        $this->app->bind(
            \App\Interfaces\Models\UserModelInterface::class,
            \App\Models\UserModel::class
        );
        $this->app->bind(
            \App\Interfaces\Models\GitHubInfoModelInterface::class,
            \App\Models\GitHubInfoModel::class
        );
        /* Libraries */
        $this->app->bind('\Goutte\Client', function ($app) {
            return new \Goutte\Client();
        });
    }

    /**
     * Register expanded auth driver
     */
    public function registerAuthDrivers()
    {
        $this->app['auth']->extend('github', function ($app) {
            $userModel = $app->make(\App\Interfaces\Models\UserModelInterface::class);
            return new \App\Authenticate\Driver\GitHubUserProvider(
                $userModel
            );
        });
    }
}
