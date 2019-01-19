<?php

namespace App\Providers;

use App\Libraries\EsEngine;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Nexmo\Call\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        resolve(EngineManager::class)->extend('es', function($app) {
            return new EsEngine(ClientBuilder::create()
                ->setHosts(config('scout.es.hosts'))
                ->build(),
                config('scout.es.index')
            );
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
