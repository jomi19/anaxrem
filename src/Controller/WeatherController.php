<?php

namespace Joakim\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    public function indexAction()
    {

        return $this->di->get("page")
            ->add("joakim/weather/search")
            ->render(["title" => "Testar"]);
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

        return $this->di->get("page")
            ->add("joakim/weather/debug", $data)
            ->render(["title" => "Testar"]);
    }

    public function historyActionPost()
    {
        $service = $this->di->get("weather");
        $history = $service->getWeatherHistory($_POST);

        if (is_string($history[0])) {
            return $this->di->get("page")
            ->add("joakim/weather/search", [$history])
            ->render(["title" => "Testar"]);
        }
        $data = [
            "data" => $history,
        ];

        return $this->di->get("page")
            ->add("joakim/weather/history", $data)
            ->render(["title" => "Testar"]);
    }
}
