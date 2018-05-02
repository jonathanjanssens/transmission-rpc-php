<?php

namespace Jtn\Transmission\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Jtn\Transmission\Transmission;
use Jtn\Transmission\Config;

class TestCase extends BaseTestCase
{

    /**
     * @var \stdClass
     */
    protected $config;

    public function setUp()
    {
        require __DIR__ . '/../vendor/autoload.php';
        $this->config = json_decode(file_get_contents(__DIR__ . '/config.json'));
    }

    /**
     * @return Transmission
     */
    protected function getTransmissionClient()
    {
        return new Transmission(new Config(
            $this->config->host, $this->config->username, $this->config->password, $this->config->port
        ));
    }

}
