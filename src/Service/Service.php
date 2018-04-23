<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-23
 * Time: 上午9:53
 */

namespace Monkey\Service;


use Monkey\Provider\LogProvider;
use Pimple\Container;

class Service extends Container
{
    protected $providers = [
        LogProvider::class
    ];
    public function __construct()
    {
        parent::__construct();
        $this->registerProviders();
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id,$value);
    }

    private function registerProviders(){
        foreach ($this->providers as $provider){
            $this->register(new $provider);
        }
    }
}