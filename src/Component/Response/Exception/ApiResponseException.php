<?php

namespace NutriCalc\Component\Response\Exception;

/**
 * Class ApiResponseException
 */
class ApiResponseException extends \Exception
{
    public function errorMessage() {
        $errorMsg = 'ApiResponse error';

        return empty($this->getMessage()) ? $errorMsg : $this->getMessage();
    }
}