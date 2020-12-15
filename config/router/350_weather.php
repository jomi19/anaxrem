<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip.",
            "mount" => "weather",
            "handler" => "\Joakim\Controller\WeatherController",
        ],
        [
            "info" => "Ip.",
            "mount" => "jsonweather",
            "handler" => "\Joakim\Controller\JsonWeatherController",
        ],
    ]
];
