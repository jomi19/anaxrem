<?php
/**
 * Configuration file to add as service in the Di container.
 */
return [

    // Services to add to the container.
    "services" => [
        "weather" => [
            "shared" => true,
            "active" => false,
            "callback" => function () {
                $weather = new Joakim\Model\Weather();
                
                $cfg = $this->get("configuration");
                $config = $cfg->load("apikeys.php");
                $settings = $config["config"] ?? null;
                $weather->setDi($this);
  
                if ($settings["weather"] ?? null) {
                    $weather->setApiKey($settings["weather"]);
                }
                return $weather;
            }
        ],
    ],
];
