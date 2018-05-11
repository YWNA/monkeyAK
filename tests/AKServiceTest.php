<?php

class AKServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $service = new \Monkey\Service\Impl\AKServiceImpl();
        $data = $service->generate();
//        $this->tester->seeInDatabase('access_secret_key', $data);
        $this->tester->seeInDatabase('access_secret_key', ['access_key' => 'miles']);
    }
}