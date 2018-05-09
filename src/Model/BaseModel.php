<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-5
 * Time: 下午1:46
 */

namespace Monkey\Model;


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
        $this->db->getConfiguration()->setResultCacheImpl($this->cache);
    }

    public function create($fields){
        $this->db->insert($this->table, $fields);
        return $this->getById((int) $this->db->lastInsertId());
    }

    public function updateById($id, $fields){
        if ($this->db->update($this->table, $fields, ['id'=>$id])){
            if ($this->cache->contains($this->generateRedisId([$id]))){
                $this->cache->delete($this->generateRedisId([$id]));
            }
        }
        return $this->getById($id);
    }

    public function updateByWhere($where, $fields){
        $sql = "SELECT id FROM `{$this->table}` WHERE {$where}";
        $ids = $this->select($sql, $where);
        $affectedNum = 0;
        foreach ($ids as $id){
            $id = (int)$id['id'];
            if ($this->db->update($this->table, $fields, ['id'=>$id])){
                if ($this->cache->contains($this->generateRedisId([$id]))){
                    $this->cache->delete($this->generateRedisId([$id]));
                }
                $affectedNum++;
            }
        }
        return $affectedNum;
    }

    public function getById($id){
        $sql = "SELECT * FROM `{$this->table}` WHERE id = ?";
        return $this->select($sql, [$id]);
    }

    public function getByWhere($where){
        $sql = "SELECT id FROM `{$this->table}` WHERE {$where}";
        $ids = $this->select($sql, $where);
        $data = [];
        foreach ($ids as $id){
            array_push($data, $this->getById((int)$id['id']));
        }
        return $data;
    }

    public function select($sql, $params, $lifetime = 3600 * 60 * 20)
    {
        $cache = new QueryCacheProfile($lifetime, $this->generateRedisId($params));
        if (is_array($params)){
            $stmt = $this->db->executeCacheQuery($sql, $params, [], $cache);
        } else {
            $stmt = $this->db->executeCacheQuery($sql, [], [], $cache);
        }
        $data = $stmt->fetchAll();
        $stmt->closeCursor();
        return $data;
    }

    private function generateRedisId($params){
        return $this->table . ':' . json_encode($params);
    }
}