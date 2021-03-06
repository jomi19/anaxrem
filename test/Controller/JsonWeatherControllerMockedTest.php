<?php

namespace Jomi19\Controller;

use PHPUnit\Framework\TestCase;
use Anax\DI\DIFactoryConfig;

/**
 * Test the SampleController.
 */
class JsonWeatherControllerMockedTest extends TestCase
{
    protected $controller;
    protected $weather;
    protected function setUp(): void
    {
        global $di;
        $di = new DIFactoryConfig();
        
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        $di->setShared("curl", "\Jomi19\Model\CurlMock");
        $this->weather = $di->get("weather");
        $this->di = $di;
        $this->controller = new JsonWeatherController();
        $this->controller->setDI($this->di);
    }

    public function testIndexAction()
    {
        $_POST["city"] = "östersund";
        $_POST["ip"] = "185.49.132.3";
        $res = $this->controller->historyActionPost();
        $res = $res[0]["data"];
        $resLenght = count($res);
        for ($x = 0; $x < $resLenght; $x++) {
            $this->assertIsInt($res[$x]["temp"]);
            $this->assertIsInt($res[$x]["humidity"]);
            $this->assertIsInt($res[$x]["dt"]);
            $this->assertIsString($res[$x]["description"]);
        }
    }

    public function testMakeUrl()
    {

        $test = [
            ["history" => true, "lon" => 20,
            "url" => "No location found"],
            ["history" => false, "city" => "östersund",
            "url" => "api.openweathermap.org/data/2.5/weather?q=östersund&appid=yourkey&units=metric&lang=se"],
            ["history" => false,
            "url" => "api.openweathermap.org/data/2.5/weather?lat=1.1&lon=1.1&appid=yourkey&units=metric&lang=se",
            "ip" => "83.255.152.42"]
        ];
        

        foreach ($test as $testCase) {
            $url = $this->weather ->makeUrl($testCase, $testCase["history"]);
            $this->assertEquals($url, $testCase["url"]);
        }
    }

    public function testCurrentActionPost()
    {
        $_POST["city"] = "östersund";
        $res = $this->controller->currentActionPost();
        $res = $res[0]["data"];
        
        $this->assertEquals($res["temp"], 10);
        $this->assertEquals($res["humidity"], 80);
        $this->assertEquals($res["windSpeed"], 5);
        $this->assertEquals($res["dt"], 1607779692);
        $this->assertEquals($res["icon"], "13n");
        $this->assertEquals($res["description"], "lätt snöfall");
    }
}
