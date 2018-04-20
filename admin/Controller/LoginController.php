<?php
/**
 * Created by PhpStorm.
 * User: webmaster
 * Date: 20.04.2018
 * Time: 14:46
 */

namespace Admin\Controller;

use Engine\Controller;
use Engine\DI\DI;

class LoginController extends Controller
{

    /**
     * LoginController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
    }


    public function form()
    {
       $this->view->render('login');
    }

}