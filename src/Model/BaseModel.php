<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-5
 * Time: 下午1:46
 */

namespace Monkey\Model;


use Doctrine\DBAL\DriverManager;
use Monkey\Container;

class BaseModel extends Container
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $connectionParams = array(
            'dbname' => env('MYSQL')['db_name'],
            'user' => env('MYSQL')['username'],
            'password' => env('MYSQL')['password'],
            'host' => env('MYSQL')['host'],
            'driver' => 'pdo_mysql',
        );
        $this->db = DriverManager::getConnection($connectionParams, $this->config);
    }

    public function create($table, $fields){
        $this->db->insert($table, $fields);
        return $this->db->lastInsertId();
    }
}