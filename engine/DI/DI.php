<?php

namespace Engine\DI;

class DI
{
    /**
     * @var array
     */
    private $_container = [];

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->_container[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->_container[$key]) ? $this->_container[$key] : null;
    }
}