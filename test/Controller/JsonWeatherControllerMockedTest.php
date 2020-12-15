<?php

namespace Joakim\Controller;

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
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $di->setShared("curl", "\Joakim\Model\CurlWeatherMock");
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

        for ($x = 0; $x < count($res); $x++) {
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
            "url" => "api.openweathermap.org/data/2.5/weather?q=östersund&appid=42551b4ba28a7768f24f603b29721d33&units=metric&lang=se"],
            ["history" => false,
            "url" => "api.openweathermap.org/data/2.5/weather?lat=63.176681518555&lon=14.636070251465&appid=42551b4ba28a7768f24f603b29721d33&units=metric&lang=se",
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
