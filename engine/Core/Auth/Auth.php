<?php

namespace Engine\Core\Auth;

use Engine\Helper\Cookie;

class Auth implements IAuth
{
    protected $authorized = false;
    protected $user;

    /**
     * @return bool
     */
    public function authorized()
    {
        return $this->authorized;
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @param $user
     */
    public function authorize($user)
    {
        Cookie::set('auth.authorized', true);
        Cookie::set('auth.user', $user);
        $this->authorized = true;
        $this->user = $user;
    }

    /**
     *
     */
    public function unAuthorize()
    {
        Cookie::delete('auth.authorized');
        Cookie::delete('auth.user');
        $this->authorized = false;
        $this->user = null;
    }

    /**
     * @return string
     */
    public static function salt()
    {
        return (string) rand(1000000000,999999999);
    }

    /**
     * @param $password
     * @param string $salt
     * @return string
     */
    public static function encryptPassword($password, $salt = '')
    {
        return hash('sha256', $password . $salt);
    }

    /**
     * @return bool
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }


}