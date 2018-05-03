<?php

namespace Jtn\Transmission\Tests;

use Jtn\Transmission\Operations\ModifyTorrent;
use Jtn\Transmission\Operations\ListTorrents;
use Jtn\Transmission\Torrent;

class TransmissionTorrentModifyTest extends TestCase
{

    public function test_the_torrent_modify_operation_will_pause_a_torrent()
    {
        $transmission = $this->getTransmissionClient();

        $operation = new ModifyTorrent;
        $operation->setIds([1])
            ->pause();
        $response = $transmission->run($operation);
        $this->assertTrue($response->success());

        $check = new ListTorrents;
        $check->setIds([1]);
        $checkResponse = $transmission->run($check);

        $this->assertEquals(
            Torrent::STATUS_STOPPED,
            $checkResponse->body()->torrents[0]->status
        );
    }

    public function test_the_torrent_modify_operation_will_start_a_torrent()
    {
        $transmission = $this->getTransmissionClient();

        $operation = new ModifyTorrent;
        $operation->setIds([1])
            ->start();
        $response = $transmission->run($operation);
        $this->assertTrue($response->success());

        $check = new ListTorrents;
        $check->setIds([1]);
        $checkResponse = $transmission->run($check);

        $this->assertNotEquals(Torrent::STATUS_STOPPED, $checkResponse->body()->torrents[0]->status);
    }

}
