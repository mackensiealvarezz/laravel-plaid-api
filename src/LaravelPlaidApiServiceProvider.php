<?php

namespace Pkboom\LaravelPlaidApi;

use Illuminate\Support\ServiceProvider;

class LaravelPlaidApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        app()->singleton('laravel-plaid-api', function () {
            return new LaravelPlaidApi();
        });

        // $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-plaid-api');
    }
    
    public function boot()
    {
        // if ($this->app->runningInConsole()) {
        //     $this->commands([
        //         FooCommand::class,
        //     ]);
        // }
        // $this->loadViewsFrom(__DIR__.'/path/to/views', 'courier');
        // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        // $this->publishes([
            // __DIR__.'/../config/laravel-plaid-api.php' => config_path('laravel-plaid-api.php'),
        // ]);
        // Blade::directive('some', function () {
        //     return '<style>'. $this->app->make('some')->styles() .'</style>';
        // });
    }
}
