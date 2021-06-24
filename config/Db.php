<?php

namespace Config;

Class Db {
    static function connection() {
        $connection = new \PDO('mysql:host=localhost;dbname=php_test;charset=utf8', 'root', '');
        $connection->setAttribute(\PDO::ATTR_ERRMODE, $connection::ERRMODE_EXCEPTION);
        return $connection;
    }
}