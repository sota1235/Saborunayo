<?php
namespace App\Providers\Services;

use Illuminate\Support\ServiceProvider;
use App\Services\GitHubService;

class GitHubServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Interfaces\Services\GitHubServiceInterface', function($app) {
            return new GitHubService();
        });
    }
}
