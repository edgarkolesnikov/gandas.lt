<?php // musu entry pointas i sistema

include "../config.php";
include "../vendor/autoload.php";

$router = new \Core\Router();
$launcher = new Core\Launcher();


$launcher-> start($router->getRouteInfo());