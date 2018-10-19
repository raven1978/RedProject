<?php


 error_reporting(E_NOTICE);
//if(isset($_REQUEST['dashboard']) && $_REQUEST['dashboard'] == 1)
//{
//    echo "<pre>";
//    print_r("DASHBOARD");
//    echo "</pre>";
//    exit();
//}

require "vendor/autoload.php";

require_once './define.php';

use MyNamespace\Connect;
use MyNamespace\Controller;
use MyNamespace\Router;

//require_once './Class/Controller.php';
//require_once './Class/Connect.php';

$config = require './Config/config.inc.php';

$routeConfig = require './Config/routes.config.php';

function sendError($message)
{
    header("Content-Type: application/json");
    http_response_code(500);
    echo json_encode(["status" => 0, "error message" => $message]);
    exit();
}

//DB CONNECTION
try {
    $db = Connect::getInstance($config);
} catch (\PDOException $exc) {
    sendError($exc->getMessage());
    exit();
}

$router  = new Router($db);

$router->loadRoutes($routeConfig);

if(!$router->validateRoute())
{
    sendError(MSG_REQUEST_INVALID);
}

$router->dispatch();


