<?php

namespace Jtn\Transmission;

class Config
{

    protected $config = [];

    /**
     * Config constructor.
     * @param string $host
     * @param string $username
     * @param string $password
     * @param int $port
     */
    public function __construct($host = '', $username = '', $password = '', $port = 15560)
    {
        $this->config = [
            'host' => $host,
            'username' => $username,
            'password' => $password,
            'port' => $port,
        ];
    }

    /**
     * Get a config value
     *
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        return isset($this->config[$name])
            ? $this->config[$name]
            : $default;
    }

    /**
     * Set a config value
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->config[$key] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

}
