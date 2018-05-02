<?php

namespace Jtn\Transmission\Tests;

class TransmissionTest extends TestCase
{

    public function test_the_list_method_returns_an_array_of_torrents()
    {
        $transmission = $this->getTransmissionClient();

        $torrents = $transmission->torrentList();
        $this->assertTrue(is_array($torrents));
        $this->assertNotNull($torrents[0]->id);
    }

}
