<?php

namespace NutriCalc\Exception;


class RouteNotFoundException extends \Exception
{
    public function errorMessage() {
        $errorMsg = 'Route Not Found';

        return empty($this->getMessage()) ? $errorMsg : $this->getMessage();
    }
}