<?php

namespace Jomi19\Model;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Ip
{
    use ContainerInjectableTrait;
    
    private $apiKey;

    private function getHostName($ipAddress, $type)
    {
        if ($type === "ipv4") {
            return gethostbyaddr($ipAddress);
        }
    }

    private function formatOutput($data) : array
    {
        $hostName = $this->getHostName($data["ip"], $data["type"]);
        $output = [
            "ip" => $data["ip"],
            "type" => $data["type"],
            "location" => [
                "country" => $data["country_name"],
                "country_code" => $data["country_code"],
                "flag" => $data["location"]["country_flag_emoji"],
                "city" => $data["city"],
                "zip" => $data["zip"],
                "latitude" => $data["latitude"],
                "longitude" => $data["longitude"]
            ],
            "host_name" => $hostName
            ];

        return $output;
    }

    public function setApiKey($api)
    {
        $this->apiKey = $api;
    }

    public function getIp($ipAdress) : array
    {
        $api = $this->apiKey;
        $url = "http://api.ipstack.com/" .  $ipAdress . "?access_key=" . $api;

        $curl = curl_init();
        $valid = filter_var($ipAdress, FILTER_VALIDATE_IP);

        if (!$valid) {
            return ["type" => "Invalid ip", "ip" => $ipAdress];
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $data = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($data, true);

        return $this->formatOutput($data);
    }

    public function getClientIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddress;
    }
}
