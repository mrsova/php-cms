<?php
/**
 * Created by PhpStorm.
 * User: webmaster
 * Date: 20.04.2018
 * Time: 15:45
 */

namespace Engine\Helper;


use function setcookie;

class Cookie
{
    /**
     * @param $key
     * @param $value
     * @param int $time
     */
    public static function set($key, $value, $time = 3153600)
    {
        setcookie($key, $value, time() + $time, '/');
    }

    /**
     * @param $key
     * @return null
     */
    public static function get($key)
    {
        if(isset($_COOKIE[$key])){
            return $_COOKIE[$key];
        }
        return null;
    }


    /**
     * @param $key
     */
    public static function delete($key)
    {
        if(isset($_COOKIE[$key])){
           self::set($key, '', -3600);
           unset($_COOKIE[$key]);
        }
    }

}