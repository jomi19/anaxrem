<?php
/**
 * Configuration file to add as service in the Di container.
 */
return [

    // Services to add to the container.
    "services" => [
        "curl" => [
            "shared" => true,
            "active" => false,
            "callback" => function () {
                $service = new Jomi19\Model\Curl();
                $service->setDi($this);
                return $service;
            }
        ],
    ],
];
