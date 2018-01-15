<?php

namespace Elasticquent;

use Illuminate\Support\ServiceProvider;

class ElasticquentLumenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
            $this->publishes([
                __DIR__.'/config/elasticquent.php' => app()->configure('elasticquent'),
            ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Support class
        $this->app->singleton('elasticquent.support', function () {
            return new ElasticquentSupport;
        });

        // Elasticsearch client instance
        $this->app->singleton('elasticquent.elasticsearch', function ($app) {
            return $app->make('elasticquent.support')->getElasticSearchClient();
        });
    }
}
