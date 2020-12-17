<?php

namespace Jomi19\Controller;

use Jomi19\Model\Ip;
use Jomi19\Controller\JsonController;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class JsonControllerTest extends TestCase
{
    protected $controller;

    protected function setUp(): void
    {
        // Init service container $di to contain $app as a service
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;
        // Create and initiate the controller
        $this->controller = new JsonController();
        $this->controller->setDI($this->di);
    }
    /**
     * Test the route "index".
     */
    public function testDataActionPost()
    {
        $test = [
            ["ip" => "fel ip", "result" => "Invalid ip"],
            ["ip" => "185.49.134.3", "result" => "ipv4", "hostName" => "www.blocket.se"],
            ["ip" => "2001:db8:85a3:8d3:1319:8a2e:370:7348", "result" => "ipv6"],
            ["ip" => "", "result" => "No ip"]];
        
        foreach ($test as $testCase) {
            $_POST["ip"] = $testCase["ip"];

            if (!$testCase["ip"]) {
                unset($_POST);
            }

            $res = $this->controller->dataActionPost();

            $this->assertEquals($testCase["result"], $res[0]["type"]);
            if (strlen($testCase["ip"] > 1)) {
                $this->assertEquals($testCase["ip"], $res[0]["ip"]);
            }
            if (isset($testCase["hostName"])) {
                $this->assertContains($testCase["hostName"], $res[0]["host_name"]);
            }
        }
    }

    public function testIndex()
    {
        $res = $this->controller->indexAction();

        $this->assertContains("Hej", $res);
    }
}
