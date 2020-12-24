<?php

namespace Jomi19\Controller;

use Anax\Commons\ContainerInjectableInterface;

use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function dataActionPost()
    {
        $json = [ "type" => "Invalid ip"];

        if (!isset($_POST["ip"]) || strlen($_POST["ip"]) < 1) {
            return [["type" => "No ip"]];
        }

        $ipAdress = $_POST["ip"];
        $ipData = $this->di->get("ip");
        $data = $ipData->getIp($ipAdress);

        return [$data];
    }

    public function indexAction()
    {
        return "Hej";
    }
}
