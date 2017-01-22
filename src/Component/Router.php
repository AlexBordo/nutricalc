<?php

namespace NutriCalc\Component;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = include(ROOT . '/src/config/routes.php');
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $innerPath) {
            if (preg_match("~$uriPattern~", $uri)){

                $internalRoute = preg_replace("~$uriPattern~", $innerPath, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = array_shift($segments) . 'Action';

                // generating Controller namespace path
                $controllerObjectPath = '\\' . PROJECT_NAME . '\Controller\\' . $controllerName;

                $controllerObject = new $controllerObjectPath();

                // calling controller action and passing parameters left in $segments
                call_user_func_array([$controllerObject, $actionName],$segments);

                break;
            }
        }
    }

    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }else{
            throw new \Exception('\'REQUEST_URI\' is empty');
        }
    }
}