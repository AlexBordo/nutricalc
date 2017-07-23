<?php
namespace NutriCalcTest\ComponentTest;

use NutriCalc\Component\Router\Routes;
use NutriCalcTest\BaseTestCase;

/**
 * RoutesTest
 */
class RoutesTest extends BaseTestCase
{
    private $routes;

    public function setUp()
    {
        $this->routes = [
            'calc/([0-9]{1,3})' => 'calculator/test/$1',
            'calc' => 'calculator/calculate',
            'fake/([a-zA-Z]{1,100})/([0-9a-zA-Z]{1,10})' => 'fake/dummy/$1/$2'
        ];
    }

    /**
     * @test
     */
    public function successfulGeneration()
    {
        $routes = new Routes($this->routes);

        $this->assertInstanceOf(Routes::class, $routes);
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Component\Router\Exception\RouterException
     */
    public function NoRoutesFoundExceptionEmptyRoutes()
    {
        $routes = new Routes('');
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Component\Router\Exception\RouterException
     */
    public function NoRoutesFoundExceptionRoutesIsNull()
    {
        $routesFile = null;

        $routes = new Routes($routesFile);
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Component\Router\Exception\RouterException
     */
    public function NoRoutesFoundExceptionRoutesIsEmptyArray()
    {
        $routesFile = [];

        $routes = new Routes($routesFile);
    }

    /**
     * @test
     */
    public function RoutesAreInstanceOfArray()
    {
        $routes = new Routes($this->routes);

        $this->assertTrue(is_array($routes->getRoutesCollection()));
    }
}