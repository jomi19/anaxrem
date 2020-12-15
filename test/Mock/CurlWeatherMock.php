<?php

namespace Joakim\Model;

class CurlWeatherMock extends Curl
{

    public function multiCurl($urls)
    {
        echo("MOCK KLASS");
        $data = [];
        $data[0] = [
            "current" => [
                "temp" => -1.84,
                "humidity" => 86,
                "wind_speed" => 5,
                "dt" => 1607720348,
                "weather" => [
                    [
                    "icon" => "04n",
                    "description" => "mulet"
                    ]
                ]
            ]
        ];

        $data[1] = [
            "current" => [
                "temp" => 20,
                "humidity" => 80,
                "wind_speed" => 10,
                "dt" => 1607720348,
                "weather" => [
                    [
                    "icon" => "sol",
                    "description" => "soligt"
                    ]
                ]
            ]
        ];

        $data[2] = [
            "current" => [
                "temp" => 30,
                "humidity" => 86,
                "wind_speed" => 5,
                "dt" => 1607720348,
                "weather" => [[
                    "icon" => "regn",
                    "description" => "regnar"
                ]]
            ]
        ];

        $data[3] = [
            "current" => [
                "temp" => 40,
                "humidity" => 90,
                "wind_speed" => 0,
                "dt" => 1607720348,
                "weather" => [
                    [
                    "icon" => "VARMT",
                    "description" => "varmt"
                    ]
                ]
            ]
        ];

        $data[4] = [
            "current" => [
                "temp" => 0,
                "humidity" => 80,
                "wind_speed" => 20,
                "dt" => 1607720348,
                "weather" => [
                    [
                    "icon" => "moln",
                    "description" => "molnigt"
                    ]
                ]
            ]
        ];

        return $data;
    }

    public function singleCurl($url)
    {
        $data = [
            "main" => [
                "temp" => 10,
                "humidity" => 80,

            ],
            "wind" => [
                "speed" => 5,
            ],
            "weather" => [
                [
                    "icon" => "13n",
                    "description" => "lätt snöfall"
                ]
            ],
            "dt" => 1607779692
        ];

        return $data;
    }
}
