<?php

namespace Jtn\Transmission\Tests;

use Jtn\Transmission\Operations\ListTorrents;

class TransmissionTest extends TestCase
{

    public function test_the_list_method_returns_an_array_of_torrents()
    {
        $transmission = $this->getTransmissionClient();

        $operation = new ListTorrents;
        $torrents = $transmission->run($operation);

        $this->assertTrue(is_array($torrents->torrents));
        $this->assertNotNull($torrents->torrents[0]->id);
    }

}
