<?php

namespace App\Providers;

use App\Services\KeywordService;
use App\Services\QueueService;
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

        $this->app->singleton('KeywordService', function () {
            return new KeywordService();
        });

        $this->app->singleton('QueueService', function () {
            return new QueueService();
        });
    }
}
