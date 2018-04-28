<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-28
 * Time: 下午3:56
 */
$config = new \Doctrine\DBAL\Configuration();
//..
$connectionParams = array(
    'dbname' => env('MYSQL')['db_name'],
    'user' => env('MYSQL')['username'],
    'password' => env('MYSQL')['password'],
    'host' => env('MYSQL')['host'],
    'driver' => 'pdo_mysql',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);