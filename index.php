<?php

/* AUTOLOAD */
$autoloadFile = __DIR__ . '/vendor/autoload.php';

if (!file_exists($autoloadFile)) {
    die('Composer autoload file does not exists');
} else {
    require_once $autoloadFile;
}

/* SETTINGS */
$settings = new \NutriCalc\Component\Settings('dev');
$settings->setAllSettings();
define('ROOT', __DIR__);
define('PROJECT_NAME' , 'NutriCalc');

/* DATA BASE CONNECTION */

/* ROUTER */
$router = new \NutriCalc\Component\Router();
$router->run();