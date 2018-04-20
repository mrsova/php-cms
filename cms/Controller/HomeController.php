<?php
/**
 * Created by PhpStorm.
 * User: webmaster
 * Date: 19.04.2018
 * Time: 11:51
 */

namespace Cms\Controller;

class HomeController extends CmsController
{
    public function index()
    {
        $data = [
            'name' => 'PAvel',
            'age' => 18
        ];
        $this->view->render('index', $data);
    }

}