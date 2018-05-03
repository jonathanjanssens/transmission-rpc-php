<?php

namespace Jtn\Transmission;

class Torrent
{

    const STATUS_STOPPED = 0;
    const STATUS_CHECK_WAIT = 1;
    const STATUS_WAIT = 2;
    const STATUS_DOWNLOAD_WAIT = 3;
    const STATUS_DOWNLOAD = 4;
    const STATUS_SEED_WAIT = 5;
    const STATUS_SEED = 6;

}
