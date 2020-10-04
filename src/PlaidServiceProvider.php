<?php

namespace Mackensiealvarezz\Plaid;

use illuminate\support\ServiceProvider;
use Pkboom\LaravelPlaidApi\Client;

class TdameritradeServiceProvider extends ServiceProvider
{


    //when the application is loaded
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind('plaid', function () {
            return new Client();
        });
    }
}
