<?php
require_once 'BaseTest.php';
class AKServiceTest extends BaseTest
{
    // tests
    public function testGenerate()
    {
        $service = new \Monkey\Service\Impl\AKServiceImpl();
        $data = $service->generate();
        $this->tester->seeInDatabase('access_secret_key', ['access_key' => $data['access_key']]);
    }
}