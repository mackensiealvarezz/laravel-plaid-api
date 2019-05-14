<?php

namespace Tests\Feature;

use Tests\TestCase;
use Pkboom\LaravelPlaidApi\Client;

class PlaidTest extends TestCase
{
    public function testBasicTest()
    {
        $id = config('services.plaid.id');
        $secret = config('services.plaid.secret');
        $publicKey = config('services.plaid.publicKey');
        $env = config('services.plaid.env');
        $publicToken = 'public_token_from_Plaid_Link';

        $client = new Client($id, $secret, $publicKey, $env);
        $response = $client->item()->publicToken()->exchange($publicToken);
        $accessToken = $response['access_token'];
    }
}
