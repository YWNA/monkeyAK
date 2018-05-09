<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-5
 * Time: 下午1:46
 */

namespace Monkey\Model;


use Doctrine\Common\Cache\RedisCache;
use Doctrine\DBAL\Cache\QueryCacheProfile;
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
        $cache = new RedisCache();
        $redis = new \Redis();
        $redis->connect('localhost', 6379);
        $cache->setRedis($redis);
        $connectionParamsRedis = array(
            'dbname' => env('MYSQL')['db_name_test'],
            'user' => env('MYSQL')['username'],
            'password' => env('MYSQL')['password'],
            'host' => env('MYSQL')['host'],
            'driver' => 'pdo_mysql',
        );
        $this->dbRedis = DriverManager::getConnection($connectionParamsRedis, $this->config);
        $this->dbRedis->getConfiguration()->setResultCacheImpl($cache);
    }

    public function create($fields){
        $this->db->insert($this->table, $fields);
        return $this->getById($this->db->lastInsertId());
    }

    public function updateById($id, $fields){
        return $this->db->update($this->table, $fields, ['id'=>$id]);
    }

    public function updateByConditions($conditions, $fields){
        return $this->db->update($this->table, $fields, $conditions);
    }

    public function getById($id){
        $sql = "SELECT * FROM `{$this->table}` WHERE id = ?";
        return $this->select($sql, [$id]);
    }

    private function select($sql, $params, $lifetime = 3600 * 60 * 20)
    {
        $cache = new QueryCacheProfile($lifetime, $this->table . ':' . json_encode($params));
        $stmt = $this->db->executeCacheQuery($sql, $params, [], $cache);
        $data = $stmt->fetchAll();
        $stmt->closeCursor();
        return $data;
    }
}