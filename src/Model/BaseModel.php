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

    protected $table;

    public function __construct()
    {
        parent::__construct();
        if ($this->isTest) {
            $connectionParams = array(
                'dbname' => env('MYSQL')['db_name_test'],
                'user' => env('MYSQL')['username'],
                'password' => env('MYSQL')['password'],
                'host' => env('MYSQL')['host'],
                'driver' => 'pdo_mysql',
            );
        } else {
            $connectionParams = array(
                'dbname' => env('MYSQL')['db_name'],
                'user' => env('MYSQL')['username'],
                'password' => env('MYSQL')['password'],
                'host' => env('MYSQL')['host'],
                'driver' => 'pdo_mysql',
            );
        }
        $this->db = DriverManager::getConnection($connectionParams, $this->config);
    }

    public function create($fields){
        $this->db->insert($this->table, $fields);
        return $this->db->lastInsertId();
    }

    public function updateById($id, $fields){
        return $this->db->update($this->table, $fields, ['id'=>$id]);
    }

    public function updateByConditions($conditions, $fields){
        return $this->db->update($this->table, $fields, $conditions);
    }

    public function getById($id){
        return $this->db->createQueryBuilder()->select()->where(['id' => $id]);
    }
}