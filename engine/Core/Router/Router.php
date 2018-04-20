<?php
/**
 * Created by PhpStorm.
 * User: webmaster
 * Date: 18.04.2018
 * Time: 16:55
 */

namespace Engine\Core\Router;


class Router
{
    /**
     * @var array
     */
    private $_routes = [];
    private $_host;
    private $_dispatcher;

    /**
     * Router constructor.
     * @param $host
     */
    public function __construct($host)
    {
        $this->_host = $host;
    }

    /**
     * @param $key
     * @param $pattern
     * @param $controller
     * @param string $method
     */
    public function add($key, $pattern, $controller, $method = 'GET')
    {
        $this->_routes[$key] = [
            'pattern'    => $pattern,
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    /**
     * @param $method
     * @param $uri
     */
    public function dispatch($method, $uri)
    {
        return $this->getDispatcher()->dispath($method, $uri);
    }

    /**
     * @return UrlDispatcher
     */
    public function getDispatcher()
    {
        if($this->_dispatcher == null)
        {
            $this->_dispatcher = new UrlDispatcher();
            foreach ($this->_routes as $route)
            {
                $this->_dispatcher->register($route['method'], $route['pattern'], $route['controller']);
            }
        }
        return $this->_dispatcher;
    }
}