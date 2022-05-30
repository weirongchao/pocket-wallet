<?php

namespace PocketWallet;

use GuzzleHttp\Client as HttpClient;
use phpDocumentor\Reflection\Types\This;
use Psr\Http\Message\ResponseInterface;

class Api
{
    private $privateKey = '';
    private $publicKey = '';
    private $param = [];
    private $url = 'http://127.0.0.1:3344/api/users';
    private $method = 'sdkTest';


    public function __construct($param, $privateKey, $publicKey)
    {
        $this->param = $param;
        $this->privateKey = $privateKey;
        $this->publicKey = $publicKey;
    }

    public function create()
    {
        return $this->request('POST', $this->url . '/' . $this . $this->method, ['data' => $this->param]);
    }


    /**
     * Make a request.
     *
     * @param string $url
     * @param string $method
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function request($method, $url, $options = [])
    {
        $method = strtoupper($method);

        $options = array_merge(self::$defaults, $options);

        $response = $this->getClient()->request($method, $url, $options);

        return $response;
    }

    /**
     * Return GuzzleHttp\Client instance.
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (!($this->client instanceof HttpClient)) {
            $this->client = new HttpClient();
        }

        return $this->client;
    }

}

