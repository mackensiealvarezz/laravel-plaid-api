<?php

namespace Pkboom\LaravelPlaidApi;

use Pkboom\LaravelPlaidApi\Api\Accounts;
use Pkboom\LaravelPlaidApi\Api\AssetReport;
use Pkboom\LaravelPlaidApi\Api\Auth;
use Pkboom\LaravelPlaidApi\Api\Balance;
use Pkboom\LaravelPlaidApi\Api\Categories;
use Pkboom\LaravelPlaidApi\Api\CreditDetails;
use Pkboom\LaravelPlaidApi\Api\Identity;
use Pkboom\LaravelPlaidApi\Api\Income;
use Pkboom\LaravelPlaidApi\Api\Institutions;
use Pkboom\LaravelPlaidApi\Api\Item;
use Pkboom\LaravelPlaidApi\Api\Transactions;
use Zttp\Zttp;
use Pkboom\LaravelPlaidApi\Exceptions\PlaidException;

class Client
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $env;

    /**
     * Plaid constructor.
     */
    public function __construct($clientId, $secret, $publicKey, $env, $apiVersion = null, $suppressWarnings = false, $timeout = self::DEFAULT_TIMEOUT)
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->publicKey = $publicKey;
        $this->env = $env;
        $this->suppressWarnings = $suppressWarnings;
        $this->timeout = $timeout;
        $this->apiVersion = $apiVersion;

        $this->requester = new Requester();

        $this->accounts = new Accounts($this);
        $this->assetReport = new AssetReport($this);
        $this->auth = new Auth($this);
        $this->balance = new Balance($this);
        $this->categories = new Categories($this);
        $this->creditDetails = new CreditDetails($this);
        $this->identity = new Identity($this);
        $this->income = new Income($this);
        $this->institutions = new Institutions($this);
        $this->item = new Item($this);
        $this->transactions = new Transactions($this);
    }

    public function accounts()
    {
        return $this->accounts;
    }

    public function assetReport()
    {
        return $this->assetReport;
    }

    public function auth()
    {
        return $this->auth;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function categories()
    {
        return $this->categories;
    }

    public function creditDetails()
    {
        return $this->creditDetails;
    }

    public function identity()
    {
        return $this->identity;
    }

    public function income()
    {
        return $this->income;
    }

    public function institutions()
    {
        return $this->institutions;
    }

    public function item()
    {
        return $this->item;
    }

    public function transactions()
    {
        return $this->transactions;
    }

    public function post($path, $data)
    {
        $postData = array_merge($data, [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
        ]);

        return $this->_post($path, $postData);
    }

    public function postPublic($path, $data)
    {
        return $this->_post($path, $data);
    }

    public function postPublicKey($path, $data)
    {
        $postData = array_merge($data, [
            'public_key' => $this->publicKey,
        ]);

        return $this->_post($path, $postData);
    }

    private function _post($path, $data)
    {
        try {
            $response = Zttp::post($this->url($path), $data);
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

    public function url($url)
    {
        return vsprintf('%s/%s', [
            "https://{$this->env}.plaid.com",
            ltrim($url, '/'),
        ]);
    }
}
