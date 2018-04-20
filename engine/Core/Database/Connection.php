<?php

namespace Engine\Core\Database;

use PDO;
use Engine\Core\Config\Config;

class Connection
{
    /**
     * @var
     */
    private $_link;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * @return $this
     */
    private function connect()
    {
        $config = Config::file('database');
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'] . ';charset=' . $config['charset'];
        $this->_link = new PDO($dsn,$config['username'] ,  $config['password']);
        return $this;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function execute($sql)
    {
        $sth = $this->_link->prepare($sql);
        return $sth->execute();
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql)
    {
        $sth = $this->_link->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($result === false){
            return [];
        }

        return $result;
    }

    public function hui()
    {
        echo 1;
    }
}