<?php
$pathsArray = [
    ROOT_DIR . 'src/Model'
];
$isDevMode = true;
$dbConfig = [
    'driver' => 'pdo_mysql',
    'host' => env('MYSQL')['host'],
    'user' => env('MYSQL')['username'],
    'password' => env('MYSQL')['password'],
    'dbname' => env('MYSQL')['db_name']
];
$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($pathsArray, $isDevMode, null, null, false);
$entityManager = \Doctrine\ORM\EntityManager::create($dbConfig, $config);