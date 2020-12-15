<?php

namespace Joakim\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class JsonWeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    public function indexAction()
    {

        return ["Weather api"];
    }

    public function currentActionPost()
    {
        $service = $this->di->get("weather");
        $weather = $service->getWeather($_POST);
        
        if (is_string($weather)) {
            return $this->di->get("page")
            ->add("joakim/weather/search", [$weather])
            ->render(["title" => "Testar"]);
        }

        $data = [
            "data" => $weather,
        ];

        return [$data];
    }

    public function historyActionPost()
    {
        $service = $this->di->get("weather");
        $history = $service->getWeatherHistory($_POST);

        $data = [
            "data" => $history,
        ];

        return [$data];
    }
}
