<?php
/**
 * Created by PhpStorm.
 * User: webmaster
 * Date: 19.04.2018
 * Time: 12:16
 */

namespace Admin\Controller;


use Engine\Controller;

use Engine\Core\Auth\Auth;

class AdminController extends Controller
{

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * AdminController constructor.
     * @param \Engine\DI\DI $di
     */
    public function __construct($di)
    {
        parent::__construct($di);

        $this->auth = new Auth();
        $this->checkAuthorization();

    }


    /**
     * Chek Auth
     */
    public function checkAuthorization()
    {
        if(!$this->auth->authorized()){
            //redirect
            header('Location: /admin/login/', true, 301);
            exit();
        }
    }


}