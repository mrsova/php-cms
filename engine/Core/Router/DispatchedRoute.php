<?php

namespace Engine\Core\Router;


class DispatchedRoute
{
    private $_controller;
    private $_parameters;

    /**
     * DispatchedRoute constructor.
     * @param $controller
     * @param array $parameters
     */
    public function __construct($controller, $parameters = [])
    {
        $this->_controller = $controller;
        $this->_parameters = $parameters;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->_parameters;
    }

}