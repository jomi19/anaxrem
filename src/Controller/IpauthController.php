<?php

namespace Jomi19\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpauthController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionPost() : object
    {
        $ipAdress = $_POST["ip"] ?? false;
        $title = "Validating " . $ipAdress;
        $ipData = $this->di->get("ip");
        $data = $ipData->getIp($ipAdress);
        $valid = filter_var($ipAdress, FILTER_VALIDATE_IP);

        
        $page = $this->di->get("page");
        $page->add("jomi19/ip/index", [
            "valid" => $valid,
            "check" => true,
            "ipData" => $data,
            "client" => $ipAdress
        ]);

        return $page->render([
            "title" => $title,

        ]);
    }

    public function indexAction() : object
    {
        $title = "Ip validation";
        $page = $this->di->get("page");
        $clientIp = $this->di->get("ip");
        $clientIp = $clientIp->getClientIp();
        
        // $active = $session->get(self::$key, null);

        $page->add("jomi19/ip/index", [
            "check" => false,
            "client" => $clientIp
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
