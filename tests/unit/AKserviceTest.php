<?php

class AKserviceTest extends \Codeception\Test\Unit
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
        $this->tester->haveInDatabase('access_secret_key', array('access_key' => 'Davert', 'secret_key' => 'davert', 'created_time' => time(), 'updated_time' => time()));
    }
}