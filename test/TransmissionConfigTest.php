<?php

namespace Jtn\Transmission\Tests;

class TransmissionConfigTest extends TestCase
{

    public function test_config_can_be_overwritten()
    {
        $transmission = $this->getTransmissionClient();

        // check that the actual host is set
        $this->assertEquals(
            $this->config->host,
            $transmission->config()->get('host')
        );

        // now override the value and check that the new value is returned
        $transmission->config()->set('host', 'localhost/transmission/rpc');
        $this->assertEquals('localhost/transmission/rpc', $transmission->config()->get('host'));
    }

}
