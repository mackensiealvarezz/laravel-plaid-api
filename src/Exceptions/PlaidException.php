<?php

namespace Pkboom\LaravelPlaidApi\Exceptions;

use Exception;

class PlaidException extends Exception
{
    public static function fromResponse($response)
    {
        // [
        //     "display_message" => null
        //     "error_code" => "INTERNAL_SERVER_ERROR"
        //     "error_message" => "an unexpected error occurred"
        //     "error_type" => "API_ERROR"
        //     "request_id" => "JcC4aaqARJefZ7C"
        //     "suggested_action" => null
        //]
        return new static(json_encode($response));
    }
}
