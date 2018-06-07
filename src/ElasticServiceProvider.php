<?php

namespace Qkktrip\LaravelElastic;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ElasticServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/config.php');

        if ($this->app instanceof Application) {
            if ($this->app->runningInConsole()) {
                $this->publishes([
                    $source => config_path('elastic.php'),
                ]);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Elastic::class, function ($app){
            return new Elastic(config('elastic'));
        });

        $this->app->alias(Elastic::class, 'elastic');
    }
}
