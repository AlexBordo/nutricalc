<?php

namespace NutriCalc\Component\Router\Factory;


use NutriCalc\Component\Router\Router;
use NutriCalc\Component\Router\Routes;
use NutriCalc\Component\Router\RoutesParser;

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
        $routesParser = new RoutesParser($routesFilePath);
        $routes = $routesParser->parseRoutes()->getRoutes();

        $routesCollection = new Routes($routes);

        $router = new Router($calledUrl, $routesCollection, $projectNamespace);

        return $router;
    }
}