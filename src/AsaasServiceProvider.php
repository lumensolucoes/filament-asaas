<?php

namespace Lumensolucoes\FilamentAsaas;

use Illuminate\Support\ServiceProvider;
use lumensolucoes\FilamentAsaas\AsaasClient;

class AsaasServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/asaas.php', 'asaas');

        $this->app->singleton(AsaasClient::class, function ($app) {
            $config = $app['config']->get('asaas');
            return new AsaasClient($config);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/asaas.php' => config_path('asaas.php'),
            ], 'config');

            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/asaas.php');
    }
}
