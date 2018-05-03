<?php

namespace Jtn\Transmission\Operations;

class ModifyTorrent extends AbstractOperation
{

    protected $method = '';

    protected $ids = [];

    /**
     * @return $this
     */
    public function start()
    {
        $this->method = 'torrent-start';
        return $this;
    }

    /**
     * @return $this
     */
    public function stop()
    {
        $this->method = 'torrent-stop';
        return $this;
    }

    /**
     * @return $this
     */
    public function pause()
    {
        return $this->stop();
    }

    /**
     * @return $this
     */
    public function delete()
    {
        $this->method = 'torrent-delete';
        return $this;
    }

    /**
     * @param $ids
     * @return $this
     */
    public function setIds(array $ids)
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function addId($id)
    {
        $this->ids[] = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function parameters()
    {
        return [
            'ids' => $this->ids,
        ];
    }

}
