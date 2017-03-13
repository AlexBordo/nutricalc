<?php

/* NAMED CONSTANTS*/
define('ROOT', dirname(__FILE__));
define('PROJECT_NAME' , 'NutriCalc');
define('ROUTES_FILE', ROOT . '/src/config/routes.php')



/* AUTOLOAD */;
require_once ROOT . '/vendor/autoload.php';



/* SETTINGS */
$settings = new \NutriCalc\Component\Settings('dev');
$settings->setAllSettings();



/* DATA BASE CONNECTION */



/* ROUTER */
if(empty($_SERVER['REQUEST_URI'])){
    throw new \Exception('\'REQUEST_URI\' is empty');
}

$URL = trim($_SERVER['REQUEST_URI'], '/');

if(!file_exists(ROUTES_FILE)){
    $response = new NutriCalc\Component\Response\ApiErrorResponse();
    $response->setStatusCode(404);
    $response->addError('Routes Does Not Exists');
    $response->send();
}

$routes = include(ROUTES_FILE);
$router = new \NutriCalc\Component\Router($URL, $routes, PROJECT_NAME);

try{
    $router->run();
}catch(\NutriCalc\Exception\RouterException $e){
    $response = new NutriCalc\Component\Response\ApiErrorResponse();
    $response->setStatusCode(404);
    $response->addError($e->getMessage());
    $response->send();
}

