<?php

namespace NutriCalc\Fixtures\Router\Controller;


class RouterController
{
    public function routerAction($parameter)
    {
        return "RouterTestController:routerAction - Parameters: {$parameter}";
    }
}