<?php

namespace Engine\Core\Router;


use function array_key_exists;
use function preg_match;
use function preg_replace_callback;
use function strtoupper;

class UrlDispatcher
{

    /**
     * @var array
     */
    private $_method = [
        'GET',
        'POSTa'
    ];

    /**
     * @var array
     */
    private $_routes = [
        'GET'  => [],
        'POST' => []
    ];

    /**
     * @var array
     */
    private $_patterns = [
        'int'  => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];

    private function routes($method){
       return isset($this->_routes[$method]) ? $this->_routes[$method] : [];
    }
    /**
     * @param $key
     * @param $pattern
     */
    public function addPattern($key, $pattern)
    {
        $this->_patterns[$key] = $pattern;
    }

    /**
     * @param $method
     * @param $pattern
     * @param $controller
     */
    public function register($method, $pattern, $controller)
    {
        $convert = $this->convertPattern($pattern);
        $this->_routes[strtoupper($method)][$convert] = $controller;
    }

    /**
     * @param $pattern
     * @return mixed
     */
    private function convertPattern($pattern){
        if (strpos($pattern, '(') === false)
        {
            return $pattern;
        }

        return preg_replace_callback('#\((\w+):(\w+)\)#',[$this, 'replacePattern'], $pattern);
    }

    /**
     * @param $parameters
     * @return mixed
     */
    private function processParam($parameters)
    {
        foreach ($parameters as $k => $value)
        {
            if(is_int($k))
            {
                unset($parameters[$k]);
            }
        }
        return $parameters;
    }

    /**
     * @param $matches
     * @return string
     */
    private function replacePattern($matches)
    {
        return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->_patterns) . ')';
    }

    /**
     * @param $method
     * @param $uri
     * @return DispatchedRoute
     */
    public function dispath($method, $uri)
    {
        $routes = $this->routes(strtoupper($method));

        if(array_key_exists($uri, $routes)){
            return new DispatchedRoute($routes[$uri]);
        }
        return $this->doDispatch($method, $uri);
    }

    /**
     * @param $method
     * @param $uri
     */
    private function doDispatch($method, $uri)
    {
        foreach ($this->routes(strtoupper($method)) as $route => $controller)
        {
            $pattern = '#^'.$route.'$#s';
            if(preg_match($pattern, $uri, $parameters)){
                return new DispatchedRoute($controller, $this->processParam($parameters));
            }
        }
    }
}