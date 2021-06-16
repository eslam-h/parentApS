<?php

namespace App\Providers;

use Dev\Domain\Service\Abstracts\DataProvider;
use Dev\Domain\Service\AllDataProvidersService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DataProvider::class, function($app) {
            return new AllDataProvidersService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
