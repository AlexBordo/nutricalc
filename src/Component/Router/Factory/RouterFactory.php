<?php

namespace NutriCalc\Component\Router\Factory;


use NutriCalc\Component\Router\Router;
use NutriCalc\Component\Router\Routes;

/**
 * Class RouterFactory
 */
class RouterFactory
{
    /**
     *
     * @param $calledUrl
     * @param $routesFilePath
     * @param $projectNamespace
     *
     * @return Router
     */
    public static function create($calledUrl, $routesFilePath, $projectNamespace)
    {
        $routes = new Routes($routesFilePath);

        $router = new Router($calledUrl, $routes, $projectNamespace);

        return $router;
    }
}