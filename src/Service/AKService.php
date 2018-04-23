<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-17
 * Time: 下午7:30
 */

namespace Monkey\Service;


class AKService extends Service
{
    public function info(){
        $this->monolog->info(__FUNCTION__ . time());
        return __FUNCTION__ . time();
    }
}