<?php

namespace Plaid;

use Zttp\Zttp;

class Requester
{
    public function post($url, $data)
    {
        try {
            $response = Zttp::post($url, $data);
        } catch (\Exception $e) {
            throw PlaidException::fromResponse([
                'error_message' => $e->getMessage(),
                'error_type' => 'API_ERROR',
                'error_code' => 'INTERNAL_SERVER_ERROR',
                'display_message' => null,
            ]);
        }

        if (array_key_exists('error_type', $response)) {
            throw PlaidException::fromResponse($response);
        }

        return $response;
    }
}
