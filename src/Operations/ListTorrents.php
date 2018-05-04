<?php

namespace Jtn\Transmission\Operations;

use Jtn\Transmission\Torrent;

class ListTorrents extends AbstractOperation
{

    protected $method = 'torrent-get';

    protected $fields = [
        'id', 'name', 'status', 'doneDate', 'haveValid', 'totalSize'
    ];

    protected $ids = [];

    /**
     * Add a torrent ID to request
     *
     * @param $id
     * @return $this
     */
    public function addId($id)
    {
        $this->ids[] = $id;
        return $this;
    }

    /**
     * Set the list of torrent IDs to get
     *
     * @param $ids
     * @return $this
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * Add a field to the list of fields to get
     *
     * @param $field
     * @return $this
     */
    public function addField($field)
    {
        $this->fields[] = $field;
        return $this;
    }

    /**
     * Set the fields to get
     *
     * @param array|string $fields
     * @return $this
     */
    public function setFields($fields = [])
    {
        if($fields === 'all')
            $this->fields = Torrent::FIELDS_AVAILABLE;
        else
            $this->fields = $fields;

        return $this;
    }

    /**
     * @return array
     */
    public function parameters()
    {
        $parameters = [];
        if(count($this->ids))
            $parameters['ids'] = $this->ids;

        $parameters['fields'] = $this->fields;
        return $parameters;
    }

}
