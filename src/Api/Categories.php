<?php

namespace Pkboom\LaravelPlaidApi\Api;

use ArrayObject;

class Categories extends Api
{
    public function get()
    {
        return $this->client()->postPublic('/categories/get', new ArrayObject());
    }
}
