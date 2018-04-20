<?php

namespace Engine;
use function call_user_func_array;
use Engine\Core\Router\DispatchedRoute;
use Engine\Helper\Common;
use function mb_strtolower;
use const true;


class Cms
{
    /**
     * @var
     */
    private $_di;

    public $router;

    /**
     * Cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->_di = $di;
        $this->router = $this->_di->get('router');
    }

    /**
     * Run Cms
     */
    public function run()
    {
        try{
            require_once __DIR__ . '/../' . mb_strtolower(ENV) . '/Route.php';

            $routerDispatch = $this->router->dispatch(Common::getMethod(),Common::getPathUrl());

            if($routerDispatch == null)
            {
                $routerDispatch = new DispatchedRoute('ErrorController:page404');
            }

            list($class, $action) = explode(':',$routerDispatch->getController(), 2);

            $controller = "\\" . ENV . "\\Controller\\". $class;
            $parameters = $routerDispatch->getParameters();
            call_user_func_array([new $controller($this->_di), $action], $parameters);

        }catch (\Exception $e){
            echo $e->getMessage();
            exit;
        }


    }
}