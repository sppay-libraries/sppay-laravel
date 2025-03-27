<?php

namespace SPPAY\SPPAYLaravel;

use Illuminate\Support\ServiceProvider;

class SppayLaravelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/sppay.php', 'sppay'
        );
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'sppay');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/sppay'),
        ], 'sppay-views');

        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        $this->publishes([
            __DIR__ . '/Config/sppay.php' => config_path('sppay.php'),
        ], 'sppay-config');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->publishesMigrations([
            __DIR__.'/Migrations' => database_path('migrations'),
        ], 'sppay-migrations');
    }
}
