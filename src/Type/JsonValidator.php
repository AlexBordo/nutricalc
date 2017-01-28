<?php

namespace NutriCalc\Type;


class JsonValidator
{
    const NOT_AN_OBJECT_ERROR = 'Invalid data given.';
    const NOT_VALID_FIELD_ERROR = ' - field is not valid.';
    const NOT_VALID_KEY_ERROR = ' - key is not valid.';
    const REQUIRED_KEY_ERROR = ' - required key does not exists.';

    const REGEX = '/^[a-zA-Z\d]+$/';

    const REQUIRED_KEYS = [
        'weight',
        'height',
        'age',
        'activity',
        'aim',
        'gender'
    ];

    private $errors = [];
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function isValidateFields()
    {
        if (!$this->isJson()) {
            $this->addError($this::NOT_AN_OBJECT_ERROR);
            return false;
        }

        $this->data = json_decode($this->data);

        $this->validateBodyContent();

        $this->checkRequiredKeyExists();

        return empty($this->errors) ? true : false;
    }

    public function getErrors()
    {
        return (array)$this->errors;
    }

    private function isJson()
    {
        json_decode($this->data);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    private function validateBodyContent()
    {
        foreach ($this->data as $key => $value) {
            if (!preg_match($this::REGEX, $value)) {
                $this->addError($value . $this::NOT_VALID_FIELD_ERROR);
            }

            if (!preg_match($this::REGEX, $key)) {
                $this->addError($value . $this::NOT_VALID_KEY_ERROR);
            }
        }
    }

    private function checkRequiredKeyExists()
    {
        foreach ($this::REQUIRED_KEYS as $key => $value){
            if(!array_key_exists($value, (array)$this->data)){
                $this->addError($value . $this::REQUIRED_KEY_ERROR);
            }
        }
    }

    private function addError($error)
    {
        array_push($this->errors, $error);
    }
}