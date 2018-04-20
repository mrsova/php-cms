<?php
/**
 * Created by PhpStorm.
 * User: webmaster
 * Date: 19.04.2018
 * Time: 12:16
 */

namespace Cms\Controller;


use Engine\Controller;

class CmsController extends Controller
{
    /**
     * CmsController constructor.
     * @param \Engine\DI\DI $di
     */
    public function __construct($di)
    {
        parent::__construct($di);
    }

    public function header()
    {
        
    }


}