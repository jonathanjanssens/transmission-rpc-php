<?php

namespace Jtn\Transmission\Operations;

class AddTorrent extends AbstractOperation
{

    protected $method = 'torrent-add';

    protected $filename = '';

    /**
     * @param string $filename
     * @return $this
     */
    public function setFilename($filename = '')
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return array
     */
    public function parameters()
    {
        return [
            'metainfo' => base64_encode(file_get_contents($this->filename)),
        ];
    }

}
