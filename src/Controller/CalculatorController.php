<?php

namespace NutriCalc\Controller;

use NutriCalc\Component\Response\ApiErrorResponse;
use NutriCalc\Component\Response\ApiResponse;
use NutriCalc\Component\Response\ApiSuccessResponse;
use NutriCalc\Component\Response\Type\ResponseStatusType;
use NutriCalc\Resources\Calculator;
use NutriCalc\Resources\JsonValidator;

class CalculatorController
{
    public function calculateAction()
    {
        $data = file_get_contents('php://input');

        $validator = new JsonValidator($data);

        if (!$validator->isValidateFields()) {
            $response = new ApiErrorResponse($validator->getErrors());
            return $response->send();
        }

        $data = json_decode($data);

        $calc = new Calculator((array)$data);

        $response = new ApiSuccessResponse($calc->calcNutritionRatio());
        return $response->send();
    }

    public function testAction($param)
    {
        $status = new ResponseStatusType('OK', 200);

        $response = new ApiResponse('body', $status, ['error1']);

        return $response->send();
    }

}