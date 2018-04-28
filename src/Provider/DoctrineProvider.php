<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-28
 * Time: 下午4:05
 */

namespace Monkey\Provider;


use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DoctrineProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $config = new Configuration();
        $connectionParams = array(
            'dbname' => env('MYSQL')['db_name'],
            'user' => env('MYSQL')['username'],
            'password' => env('MYSQL')['password'],
            'host' => env('MYSQL')['host'],
            'driver' => 'pdo_mysql',
        );
        $pimple['DBAL'] = DriverManager::getConnection($connectionParams, $config);
    }

}