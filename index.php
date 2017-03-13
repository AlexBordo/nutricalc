<?php

/* NAMED CONSTANTS */
define('ROOT', dirname(__FILE__));
define('PROJECT_NAMESPACE', 'NutriCalc');
define('ROUTES_FILE', ROOT . '/src/config/routes.php');


/* AUTOLOAD */
require_once ROOT . '/vendor/autoload.php';


/* SETTINGS */
$settings = new \NutriCalc\Component\Settings\Settings('dev');
$settings->setAllSettings();


/* DATA BASE CONNECTION */


/* ROUTER */
if (empty($_SERVER['REQUEST_URI'])) {
    throw new \Exception('\'REQUEST_URI\' is empty');
}

$URL = trim($_SERVER['REQUEST_URI'], '/');

try {
    $router = \NutriCalc\Component\Router\Factory\RouterFactory::create($URL, ROUTES_FILE, PROJECT_NAMESPACE);
    $router->run();
} catch (\NutriCalc\Component\Router\Exception\RouterException $e) {
    $response = new NutriCalc\Component\Response\ApiErrorResponse();
    $response->setStatusCode(404);
    $response->addError($e->getMessage());
    $response->send();
}

