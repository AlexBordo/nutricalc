<?php

namespace NutriCalc\Component\Response;


use NutriCalc\Component\Response\Type\ResponseStatusType;

final class ApiSuccessResponse extends ApiResponse
{
    public function __construct($responseBody = false, $statusText = 'OK', $statusCode = 200, $errors = false)
    {
        $status = new ResponseStatusType($statusText, $statusCode);

        parent::__construct($responseBody, $status, $errors);
    }
}