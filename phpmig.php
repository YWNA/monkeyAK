<?php

use Pimple\Container;
$env = require_once './env.php';
$env_test = require_once './env.test.php';
$container = new Container();
$container['db'] = function () use($env) {
    $dbh = new PDO("mysql:dbname={$env['db_name']};host={$env['host']}",$env['username'],$env['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};
$container['db_test'] = function () use($env_test) {
    $dbh = new PDO("mysql:dbname={$env_test['db_name']};host={$env_test['host']}",$env_test['username'],$env_test['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};
$container['phpmig.adapter'] = function ($c){
    return new Phpmig\Adapter\PDO\Sql($c['db'], 'migrations');
};
$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';
return $container;