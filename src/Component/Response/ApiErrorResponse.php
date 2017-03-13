<?php

namespace NutriCalc\Component\Response;


use NutriCalc\Component\Response\Type\ResponseStatusType;

final class ApiErrorResponse extends ApiResponse
{
    public function __construct($errors = [], $statusText = 'ERROR', $statusCode = 200, $responseBody = false)
    {
        $status = new ResponseStatusType($statusText, $statusCode);

        parent::__construct($responseBody, $status, $errors);
    }
}