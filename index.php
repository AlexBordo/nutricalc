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
    $response = new \NutriCalc\Component\Response('', 'ERROR', 'Routes Does Not Exists', 404);
    $response->send();
}

$routes = include(ROUTES_FILE);
$router = new \NutriCalc\Component\Router($URL, $routes, PROJECT_NAME);
$router->run();

var_dump($router);die;

try{
    $router->run();
}catch (\NutriCalc\Exception\RouteNotFoundException $e){
    $response = new \NutriCalc\Component\Response('', 'ERROR', $e->errorMessage(), 404);
    $response->send();
}catch (\NutriCalc\Exception\EmptyRoutesFileException $e){
    $response = new \NutriCalc\Component\Response('', 'ERROR', $e->errorMessage(), 404);
    $response->send();
}catch (\NutriCalc\Exception\ProjectNameNotSetException $e){
    $response = new \NutriCalc\Component\Response('', 'ERROR', $e->errorMessage(), 404);
    $response->send();
}catch (\NutriCalc\Exception\RouterException $e){
    $response = new \NutriCalc\Component\Response('', 'ERROR', $e->errorMessage(), 404);
    $response->send();
}

