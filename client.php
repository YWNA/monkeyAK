<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-4-11
 * Time: 下午5:39
 */
$env = require_once 'env.php';
$client = new Yar_Client("http://{$env['RPC_SERVICE_DOMAIN']}/rpc.php?service=ak");
$client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
$client->SetOpt(YAR_OPT_HEADER, array("ak: val"));
//$result = $client->info();
//var_dump($result);
//$result = $client->generate();
//var_dump($result);
$time = time();
$result = $client->sign('936a8538d00540db8e330db1899d64fb', ['chenbo'=>'chenbo'], $time);
var_dump($result);
$result = $client->checkSign('936a8538d00540db8e330db1899d64fb', ['chenbo'=>'chenbo'], $time, $result);
var_dump($result);