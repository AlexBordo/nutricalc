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

/* DATA BASE CONNECTION */

/* ROUTER */