<?php

define('DB_HOST', 'db');
define('DB_NAME', 'php-docker-db');
define('DB_USER', 'user');
define('DB_PASS', 'password');

// DB接続関数

function db_connect()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $user = DB_USER;
    $password = DB_PASS;

    try {
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }

    return $dbh;
}