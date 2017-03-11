<?php
namespace NutriCalcTest\ComponentTest;

use NutriCalc\Component\Router;
use NutriCalc\Fixtures\Router\Controller\RouterController;
use NutriCalcTest\BaseTestCase;

/**
 * RouterTest
 */
class RouterTest extends BaseTestCase
{
    /**
     * @var string
     */
    public $url = 'calc';

    /**
     * Stores routes as array
     *
     * @var array
     */
    public $routes;

    /**
     * @var string
     */
    public $projectName = 'NutriCalc';

    public function setUp()
    {
        $this->routes = include 'routes.php';
    }

    /**
     * Test that Router created successfully
     *
     * @test
     */
    public function RouterBuild()
    {
        $urlCall = 'calc';

        $router = new Router($urlCall, $this->routes, $this->projectName);
        $this->assertInstanceOf(Router::class, $router);
        $this->assertEquals('calc', $router->getUrl());
        $this->assertEquals($this->routes, $router->getRoutes());
        $this->assertEquals($this->projectName, $router->getProjectName());
    }

    /**
     * Test for EmptyRoutesFileException
     *
     * @test
     *
     * @expectedException \NutriCalc\Exception\EmptyRoutesFileException
     */
    public function EmptyRoutesFileException()
    {
        $urlCall = 'calc';
        $routes = [];

        $router = new Router($urlCall, $routes, $this->projectName);
        $router->run();
    }

    /**
     *
     *
     * @test
     *
     * @expectedException \NutriCalc\Exception\RouteNotFoundException
     */
    public function RouteNotFoundException()
    {
        $urlCall = 'calc/not/existing/url/';

        $router = new Router($urlCall, $this->routes, $this->projectName);
        $router->run();
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Exception\ProjectNameNotSetException
     */
    public function ProjectNameNotSetException()
    {
        $uri = 'calc';
        $projectName = '';

        $router = new Router($uri, $this->routes, $projectName);
        $router->run();
    }

    /**
     * @test
     */
    public function RoutesAreInstanceOfArray()
    {
        $this->assertTrue(is_array($this->routes));
    }

    /**
     * @test
     */
    public function cleanUpUrlMethod()
    {
        $router = new Router('foo/bar?test=what&excluded=yes', $this->routes, $this->projectName);

        $clearUrl = $this->invokeMethod($router, 'cleanUpUrl', ['foo/bar?test=what&excluded=yes']);

        $this->assertEquals('foo/bar', $clearUrl);
    }

    /**
     * @test
     */
    public function explodeRouteMethod()
    {
        $router = new Router($this->url, $this->routes, $this->projectName);

        $internalRoute = 'calculator/calculate/param1/param2';

        $segments = $this->invokeMethod($router, 'explodeRoute', [$internalRoute]);

        $expected = [
            'controllerName' => 'CalculatorController',
            'actionName' => 'calculateAction',
            'parameters' => [
                'param1',
                'param2'
            ]
        ];

        $this->assertEquals($expected, $segments);
    }

    /**
     * @test
     */
    public function generateInternalRouteMethod()
    {
        $router = new Router('calculator/test/param1', $this->routes, $this->projectName);

        $urlPattern = 'calc/([0-9a-zA-Z]+)';
        $innerPath = 'calculator/test/$1';

        $internalRoute = $this->invokeMethod($router, 'generateInternalRoute', [$urlPattern, $innerPath]);
        $expected = 'calculator/test/param1';

        $this->assertEquals($expected, $internalRoute);
        $this->assertEquals($expected, $router->getInternalRoute());
    }


    /**
     * @test
     *
     * @expectedException \NutriCalc\Exception\RouterException
     */
    public function generateControllerObjectMethodException()
    {
        $router = new Router('router/test', $this->routes, 'RouterTest');

        $this->invokeMethod($router, 'generateControllerObject', []);
    }

    /**
     * @test
     */
    public function generateControllerObjectMethod()
    {
        $router = new Router('router/test', $this->routes, 'NutriCalc\Fixtures\Router');
        $router->setControllerName('RouterController');

        $controllerObject = $this->invokeMethod($router, 'generateControllerObject', []);

        $this->assertInstanceOf(RouterController::class, $controllerObject);
    }

    /**
     * @test
     */
    public function setControllerNameMethod()
    {
        $router = new Router('router/test', $this->routes, 'NutriCalc\Fixtures\Router');
        $router->setControllerName('RouterController');

        $this->assertEquals($router->getControllerName(),'RouterController');
    }
}