<?php

use Pimple\Container;

$container = new Container();
$container['db'] = function (){
    $dbh = new PDO('mysql:dbname=testdb;host=127.0.0.1','root','root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};
$container['phpmig.adapter'] = function ($c){
    return new Phpmig\Adapter\PDO\Sql($c['db'], 'migrations');
};
$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';
return $container;