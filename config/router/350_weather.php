<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip.",
            "mount" => "weather",
            "handler" => "\Jomi19\Controller\WeatherController",
        ],
        [
            "info" => "Ip.",
            "mount" => "jsonweather",
            "handler" => "\Jomi19\Controller\JsonWeatherController",
        ],
    ]
];
