<?php
/**
 * Configuration file to add as service in the Di container.
 */
return [

    // Services to add to the container.
    "services" => [
        "ip" => [
            "shared" => true,
            "active" => false,
            "callback" => function () {
                $ipModel = new Joakim\Model\Ip();

                $cfg = $this->get("configuration");
                $config = $cfg->load("apikeys.php");
                $settings = $config["config"] ?? null;

                if ($settings["ip"] ?? null) {
                    $ipModel->setApiKey($settings["ip"]);
                }

                return $ipModel;
            }
        ],
    ],
];
