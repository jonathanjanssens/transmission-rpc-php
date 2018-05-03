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

    const FIELDS_AVAILABLE = [
        'activityDate', 'addedDate', 'announceResponse', 'announceURL', 'bandwidthPriority', 'comment', 'corruptEver',
        'creator', 'dateCreated', 'desiredAvailable', 'doneDate', 'downloadDir', 'downloadedEver', 'downloaders',
        'downloadLimit', 'downloadLimited', 'error', 'errorString', 'eta', 'files', 'fileStats', 'hashString',
        'haveUnchecked', 'haveValid', 'honorsSessionLimits', 'id', 'isPrivate', 'lastAnnounceTime', 'lastScrapeTime',
        'leechers', 'leftUntilDone', 'manualAnnounceTime', 'maxConnectedPeers', 'name', 'nextAnnounceTime',
        'nextScrapeTime', 'peer-limit', 'peers', 'peersConnected', 'peersFrom', 'peersGettingFromUs', 'peersKnown',
        'peersSendingToUs', 'percentDone', 'pieces', 'pieceCount', 'pieceSize', 'priorities', 'rateDownload',
        'rateUpload', 'recheckProgress', 'scrapeResponse', 'scrapeURL', 'seeders', 'seedRatioLimit', 'seedRatioMode',
        'sizeWhenDone', 'startDate', 'status', 'swarmSpeed', 'timesCompleted', 'trackers', 'totalSize', 'torrentFile'.
        'uploadedEver', 'uploadLimit', 'uploadLimited', 'uploadRatio', 'wanted', 'webseeds', 'webseedsSendingToUs',
    ];

}
