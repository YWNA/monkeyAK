<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-17
 * Time: 下午7:28
 */

namespace Monkey;

require_once dirname(__DIR__) . '/vendor/autoload.php';

class Kernel
{
    public function run(){
        $className = 'AKService';
        $stdClass = "\\Monkey\\Service\\{$className}";
        $instance = new $stdClass;
        $server = new \Yar_Server($instance);
        $server->handle();
    }
}