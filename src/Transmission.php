<?php

namespace Jtn\Transmission;

use GuzzleHttp\Client;
use Jtn\Transmission\Exception\AuthenticationException;
use Jtn\Transmission\Operations\AbstractOperation;

class Transmission
{

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $sessionId = '';

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new Client;

        $this->authenticate();
    }

    /**
     * Get the config object
     *
     * @return Config
     */
    public function config()
    {
        return $this->config;
    }

    protected function authenticate()
    {
        try {
            $response = $this->httpClient->request('POST', $this->config->host . ':' . $this->config->port, [
                'auth' => [$this->config->username, $this->config->password],
                'json' => [
                    'method' => 'session-get',
                ],
            ]);
            $sessionId = $response->getHeader('X-Transmission-Session-Id');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $sessionId = $e->getResponse()->getHeader('X-Transmission-Session-Id');
        }

        if(!$sessionId) {
            throw new AuthenticationException;
        }

        $this->sessionId = $sessionId;
    }

    /**
     * Run a request for the given operation
     *
     * @param AbstractOperation $operation
     * @return mixed
     */
    public function run(AbstractOperation $operation)
    {
        return $this->request($operation->method(), $operation->parameters())->arguments;
    }

    protected function request($action, $parameters = [])
    {
        $response = $this->httpClient->request('POST', $this->config->host . ':' . $this->config->port, [
            'headers' => [
                'X-Transmission-Session-Id' => $this->sessionId,
            ],
            'auth' => [$this->config->username, $this->config->password],
            'json' => [
                'method' => $action,
                'arguments' => $parameters
            ],
        ]);

        $json = \GuzzleHttp\json_decode($response->getBody()->getContents());
        return $json;
    }

}
