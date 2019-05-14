<?php

namespace Pkboom\LaravelPlaidApi\Api;

class Categories extends Api
{
    public function get()
    {
        return $this->client->post('/categories/get');
    }
}
