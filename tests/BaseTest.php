<?php
/**
 * Created by PhpStorm.
 * User: chenbo
 * Date: 18-5-14
 * Time: 下午4:23
 */

class BaseTest extends \Codeception\Test\Unit
{
    protected $tester;

    protected function _before()
    {
        putenv('isTest=true');
    }

    protected function _after()
    {

    }
}