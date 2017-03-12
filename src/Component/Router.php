<?php

namespace NutriCalc\Component;

use NutriCalc\Exception\EmptyRoutesFileException;
use NutriCalc\Exception\ProjectNameNotSetException;
use NutriCalc\Exception\RouteNotFoundException;
use NutriCalc\Exception\RouterException;

class Router
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var string
     */
    private $url;

    /**
     * @var
     */
    private $internalRoute;

    /**
     * @var string
     */
    private $projectName;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var string
     */
    private $actionName;

    /**
     * @var array
     */
    private $parameters;

    public function __construct($url, $routes, $projectName)
    {
        $this->url = $this->cleanUpUrl($url);
        $this->routes = $routes;
        $this->projectName = $projectName;
    }

    /**
     * Method 'run' making few checks and runs 'execute' if checks are passed
     *
     * @throws EmptyRoutesFileException
     * @throws ProjectNameNotSetException
     * @throws RouteNotFoundException
     *
     * @return bool
     */
    public function run()
    {
        if (empty($this->routes)) {
            throw new EmptyRoutesFileException();
        }

        if (empty($this->projectName)) {
            throw new ProjectNameNotSetException();
        }

        try {
            $this->findRoute();
        } catch (RouterException $e) {
            // ololo

        }

        return $this->execute();
    }

    /**
     *
     * @throws RouterException
     */
    private function findRoute()
    {
        foreach ($this->routes as $urlPattern => $internalRoute) {
            if (preg_match("~^$urlPattern$~", $this->url)) {
                $internalRoute = $this->generateInternalRoute($urlPattern, $internalRoute);
                $routeSegments = $this->explodeRoute($internalRoute);

                $this->setControllerName($routeSegments['controllerName']);
                $this->setActionName($routeSegments['actionName']);
                $this->setParameters($routeSegments['parameters']);

                return true;
            }
        }

        throw new RouterException();
    }


    /**
     * @param $urlPattern
     * @param $innerPath
     *
     * @return mixed
     */
    private function generateInternalRoute($urlPattern, $innerPath)
    {
        $this->internalRoute = preg_replace("~$urlPattern~", $innerPath, $this->url);

        return $this->internalRoute;
    }

    /**
     *
     */
    private function execute()
    {
        $controllerObject = $this->generateControllerObject();

        call_user_func_array([$controllerObject, $this->actionName], $this->parameters);
    }

    /**
     * Separates url from GET parameters passed and returns url part only
     *
     * @param $url
     *
     * @return mixed
     */
    private function cleanUpUrl($url)
    {
        // RegExp instead
        $url = explode('?', $url);
        $cleanUrl = array_shift($url);

        return $cleanUrl;
    }

    /**
     * Explode internal route in to array and generates valid Controller and Action names
     *
     * @example:
     * internal route - 'calculator/calculate/param1/param2'
     * will return:
     * [
     *   controllerName => 'CalculatorController',
     *   actionName     => 'calculateAction',
     *   parameters     => [
     *                       0 => 'param1',
     *                       1 => 'param2'
     *                     ]
     * ]
     *
     * @param string $route
     *
     * @return array $routeSegments
     */
    private function explodeRoute($route)
    {
        $routeSegmentsRaw = explode('/', $route);

        $routeSegments['controllerName'] = ucfirst($routeSegmentsRaw[0]) . 'Controller';
        $routeSegments['actionName'] = $routeSegmentsRaw[1] . 'Action';
        $routeSegments['parameters'] = array_slice($routeSegmentsRaw, 2);

        return $routeSegments;
    }

    /**
     * @param string $controllerName
     *
     * @return $this
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;

        return $this;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param string $actionName
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return mixed
     * @throws RouterException
     */
    private function generateControllerObject()
    {
        $controllerObjectPath = '\\' . $this->projectName . '\Controller\\' . $this->controllerName;

        if (!class_exists($controllerObjectPath)) {
           throw new RouterException("Controller '{$controllerObjectPath}' Not Found!");
        }

        return new $controllerObjectPath();
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getProjectName()
    {
        return $this->projectName;
    }

    public function getInternalRoute()
    {
        return $this->internalRoute;
    }
}