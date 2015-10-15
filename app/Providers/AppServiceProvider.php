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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* Services */
        $this->app->bind(App\Interfaces\Services\GitHubServiceInterface::class,
            App\Services\GitHubService::class
        );
        $this->app->bind(App\Interfaces\Services\UserServiceInterface::class,
            App\Services\UserService::class
        );
        $this->app->bind(App\Interfaces\Services\YoServiceInterface::class,
            App\Services\YoService::class
        );
        /* Models */
        $this->app->bind(App\Interfaces\Models\UserModelInterface::class,
            App\Models\UserModel::class
        );
    }
}
