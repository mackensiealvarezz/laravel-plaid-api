<?php

namespace Pkboom\LaravelPlaidApi\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pkboom\LaravelPlaidApi\LaravelPlaidApiClass
 */
class LaravelPlaidApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-plaid-api';
    }
}
