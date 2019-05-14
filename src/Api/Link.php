<?php

namespace Pkboom\LaravelPlaidApi\Api;

class Link extends Api
{
    public function exchange($publicToken)
    {
        return $this->client->postWithAuth('/item/public_token/exchange', [
            'public_token' => $publicToken
        ]);
    }

    public function create($publicToken)
    {
        return $this->client->postWithAuth('/item/public_token/create', [
            'public_token' => $publicToken
        ]);
    }
}
