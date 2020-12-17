<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip.",
            "mount" => "ip",
            "handler" => "\Jomi19\Controller\IpauthController",
        ],
        [
            "info" => "Json ip.",
            "mount" => "jsonip",
            "handler" => "\Jomi19\Controller\JsonController",
        ],
    ]
];
