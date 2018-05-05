<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-28
 * Time: 上午9:17
 */

namespace Monkey\Service\Impl;

use Monkey\Model\Impl\AccessSecretKeyModelImpl;
use Monkey\Service\AKService;
use Monkey\Service\Service;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class AKServiceImpl extends Service implements AKService
{
    public function info(){
        $this->monolog->info(__FUNCTION__);
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

        $model = new AccessSecretKeyModelImpl();
        $ret = $model->create(['access_key' => $accessKey, 'secret_key' => $secretKey]);

        return [$accessKey, $secretKey, $ret];
    }
}