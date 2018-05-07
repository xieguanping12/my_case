<?php

class Db
{
    public static $instance;
    public static $conn;
    public static $db_config = [
        'host'      => DbConst::HOST,
        'user_name' => DbConst::USER_NAME,
        'password'  => DbConst::PASSWORD,
        'db'        => DbConst::DB,
    ];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (! self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
        die('db class forbidden clone');
    }

    public function connect()
    {
        $dbconfig = self::$db_config;
        $connect = new mysqli(
            $dbconfig['host'],
            $dbconfig['user_name'],
            $dbconfig['password'],
            $dbconfig['db']
        );
        if ($connect->connect_error) {
            die('连接数据库失败');
        }

        $connect->query('set names utf8');
        $connect->select_db('test');

        return $connect;
    }
}