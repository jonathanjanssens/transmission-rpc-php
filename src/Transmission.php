<?php

namespace Jtn\Transmission;

use GuzzleHttp\Client;
use Jtn\Transmission\Exception\AuthenticationException;

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
     * Get a list of all torrents
     *
     * @return mixed
     */
    public function torrentList()
    {
        return $this->torrentGet();
    }

    /**
     * Get a list of torrents with the given ids, will return
     * all torrents if the $ids parameter is not supplied
     *
     * @param integer|array|null $ids
     * @return mixed
     */
    public function torrentGet($ids = null)
    {
        $parameters = [
            'fields' => [
                'id', 'name', 'status', 'doneDate', 'haveValid', 'totalSize'
            ]
        ];

        if($ids !== null) {
            $ids = is_array($ids) ? $ids : [$ids];
            $parameters['ids'] = $ids;
        }

        return $this->request('torrent-get', $parameters)->arguments->torrents;
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
