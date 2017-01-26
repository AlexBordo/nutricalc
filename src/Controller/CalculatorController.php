<?php

namespace NutriCalc\Controller;

use NutriCalc\Type\Calculator;
use NutriCalc\Type\JsonValidator;

class CalculatorController
{
    public function calculateAction()
    {
        $data = file_get_contents('php://input');

        $validator = new JsonValidator($data);

        if(!$validator->isValidateFields()){
            echo json_encode((object)$validator->getErrors());
            return;
        }

        $data = json_decode($data);

        $calc = new Calculator((array)$data);

        var_dump($calc);
    }

}