<?php

namespace Jtn\Transmission\Tests;

use Jtn\Transmission\Operations\AddTorrent;
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

    public function test_the_add_torrent_method_uploads_the_new_torrent()
    {
        $transmission = $this->getTransmissionClient();

        $operation = new AddTorrent;
        $operation->setFilename(__DIR__ . '/resources/BigBuckBunny.torrent');

        $response = $transmission->run($operation);

        $this->assertTrue((
            isset($response->{'torrent-duplicate'}) ||
            isset($response->{'torrent-added'})
        ));
    }

}
