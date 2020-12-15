<?php

namespace Joakim\Model;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Weather implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $baseUrl = "api.openweathermap.org/data/2.5/weather";
    private $historyUrl = "https://api.openweathermap.org/data/2.5/onecall/timemachine";
    private $long;
    private $lat;
    private $apiKey;

    public function setApiKey($api)
    {
        $this->apiKey = $api;
    }

    public function makeUrl($params, $history = false) : string
    {
        $url = $this->baseUrl . "?";

        if ($history) {
            $url = $this->historyUrl . "?";
        }

        if (isset($params["city"]) && strlen($params["city"]) > 0 && !$history) {
            $url = $url . "q=" . $params["city"];
        } elseif (isset($params["ip"])) {
            $service = $this->di->get("ip");
            $cordinates = $service->getIp($params["ip"]);

            if (!isset($cordinates["location"])) {
                return "No location found";
            }
            $this->long= $cordinates["location"]["longitude"];
            $this->lat = $cordinates["location"]["latitude"];
            
            $url = $url . "lat=" . $this->lat . "&lon=" . $this->long;
        } else {
            return "No location found";
        }

        $url = $url . "&appid=" . $this->apiKey . "&units=metric&lang=se";

        return $url;
    }

    public function getWeather($params)
    {
        $url = $this->makeUrl($params);

        if ($url === "No location found") {
            return "No location found";
        }

        $service = $this->di->get("curl");
        $data = $service->singleCurl($url);
        
        if (!isset($data["main"]) || $data["main"] === null) {
            return "No location found";
        }
        $data = $this->formatWeather($data);
 
        return $data;
    }

    public function formatWeather($weather)
    {
        if (is_string($weather)) {
            return ["temp" => "Fel"];
        }
        if (isset($weather["main"])) {
            return [
                "temp" => $weather["main"]["temp"],
                "humidity" => $weather["main"]["humidity"],
                "windSpeed" => $weather["wind"]["speed"],
                "icon" => $weather["weather"][0]["icon"],
                "dt" => $weather["dt"],
                "description" => $weather["weather"][0]["description"]
            ];
        } else {
            return [
                "temp" => $weather["current"]["temp"],
                "humidity" => $weather["current"]["humidity"],
                "windSpeed" => $weather["current"]["wind_speed"],
                "icon" => $weather["current"]["weather"][0]["icon"],
                "dt" => $weather["current"]["dt"],
                "description" => $weather["current"]["weather"][0]["description"]
            ];
        }

        return $output;
    }

    public function getWeatherHistory($params)
    {
        $service = $this->di->get("curl");
        $date = time();
        $allUrl = [];
        $allData = [];

        for ($x = 0; $x <= 5; $x++) {
            $url = $this->makeUrl($params, true);
            
            if ($url != "No location found") {
                $url = $url . "&dt=" . $date;
            }
            $date = strtotime("-1day", $date);
            $allUrl[] = $url;
        }

        if ($allUrl[0] === "No location found") {
            return "No location found";
        }
        $data = $service->multiCurl($allUrl);

        for ($x = 0; $x < count($data); $x++) {
            if ($x > 0) {
                $allData[] = $this->formatWeather($data[$x]);
            }
        }

        return $allData;
    }
}
