<?php

namespace App\Providers;

use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('UserService', function () {
            return new UserService();
        });

        $this->app->singleton('FileService', function () {
            return new FileService();
        });
    }
}
