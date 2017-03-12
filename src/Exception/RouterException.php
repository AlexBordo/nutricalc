<?php

namespace NutriCalc\Exception;


class RouterException extends \Exception
{
    public function errorMessage() {
        $errorMsg = 'Router error';

        return empty($this->getMessage()) ? $errorMsg : $this->getMessage();
    }
}