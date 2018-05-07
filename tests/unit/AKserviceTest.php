<?php

class AKserviceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
//        todo 单元测试时切换至测试数据库
    }

    protected function _after()
    {
    }

    // tests
    public function testGenerate()
    {
        $model = new \Monkey\Service\Impl\AKServiceImpl();
        $ak = $model->generate();
        $this->tester->assertNotEmpty($ak);
    }

}