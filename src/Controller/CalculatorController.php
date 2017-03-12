<?php

namespace NutriCalc\Controller;

use NutriCalc\Component\Response;
use NutriCalc\Resources\Calculator;
use NutriCalc\Resources\JsonValidator;

class CalculatorController
{
    public function calculateAction()
    {
        $data = file_get_contents('php://input');

        $validator = new JsonValidator($data);

        if (!$validator->isValidateFields()) {
            $response = new Response('', 'ERROR', $validator->getErrors());
            $response->send();
        }

        $data = json_decode($data);

        $calc = new Calculator((array)$data);

        $response = new Response($calc->calcNutritionRatio());
        $response->send();
    }
}