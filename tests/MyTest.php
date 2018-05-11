<?php

class MyTest extends \Codeception\Test\Unit
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
        $this->tester->haveInDatabase('access_secret_key', array('access_key' => 'miles', 'secret_key' => 'miles@davis.com'));
        $this->tester->seeInDatabase('access_secret_key', ['access_key' => 'miles']);
    }
}