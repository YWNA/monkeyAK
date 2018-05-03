<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-28
 * Time: 上午9:17
 */

namespace Monkey\Service\Impl;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Monkey\Service\AKService;
use Monkey\Service\Service;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class AKServiceImpl extends Service implements AKService
{
    public function info(){
        $this->monolog->info(__CLASS_);
        return __FUNCTION__;
    }

    public function generate()
    {
        try {
            $accessKey = Uuid::uuid4();
            $secretKey = Uuid::uuid4();
        } catch (UnsatisfiedDependencyException $e){
            $message = $e->getMessage();
            $this->monolog->error($message, [__CLASS__, __FUNCTION__]);
            return [];
        }
        $accessKey = join('', explode('-', $accessKey->toString()));
        $secretKey = join('', explode('-', $secretKey->toString()));

        $queryBuilder = $this->DBAL->createQueryBuilder();
//        $queryBuilder->insert('access_secret_key')->values(['access_key' => $accessKey,'secret_key' => $secretKey]);
        $queryBuilder->insert('access_secret_key')
            ->values(['access_key' => '?','secret_key' => '?', 'created_time' => time(), 'updated_time' => time()])
            ->setParameter(0, $accessKey)
            ->setParameter(1, $secretKey);
        $queryBuilder->execute();
        $sql = "SELECT * FROM `access_secret_key`";
        $result = $this->DBAL->query($sql);
        $this->monolog->info(print_r($result->fetchAll(), true));
        return [$accessKey, $secretKey];
    }

    public function orm(){
        $pathsArray = [
            ROOT_DIR . 'src/Model'
        ];
        $isDevMode = false;
        $dbConfig = [
            'driver' => 'pdo_mysql',
            'user' => env('MYSQL')['user'],
            'password' => env('MYSQL')['password'],
            'dbname' => env('MYSQL')['db_name']
        ];

        return ;
    }
}