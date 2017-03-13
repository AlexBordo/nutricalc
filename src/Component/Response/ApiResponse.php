<?php

namespace NutriCalc\Component\Response;


use NutriCalc\Component\Response\Type\ResponseStatusTypeInterface;

class ApiResponse
{
    /**
     * @var ResponseStatusTypeInterface
     */
    private $status;

    /**
     * @var string
     */
    private $responseBody;

    /**
     * @var array
     */
    private $errors = [];

    public function __construct($responseBody, ResponseStatusTypeInterface $status, $errors)
    {
        $this->responseBody = $responseBody;
        $this->status = $status;
        if($errors){
            $this->setupErrors($errors);
        }
    }

    /**
     *
     */
    public function send()
    {
        $response = new \stdClass();
        $response->status = $this->status;
        !empty($this->errors) ? $response->errors = $this->errors : $response->errors = false;
        !empty($this->responseBody) ? $response->body = $this->responseBody : $response->body = false;

        header('Content-Type: application/json');
        http_response_code($this->status->getStatusCode());
        echo json_encode($response);

        return $response;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @param $error
     * @return $this
     */
    public function addError($error)
    {
        array_push($this->errors, $error);

        return $this;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function addErrors(array $errors)
    {
        foreach ($errors as $key => $error){
            array_push($this->errors, $error);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $errors
     * @return $this
     */
    private function setupErrors($errors)
    {
        if (is_array($errors)){
            foreach ($errors as $key => $value){
                array_push($this->errors, $value);
            }
        }else{
            array_push($this->errors, $errors);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getStatusText()
    {
        return $this->status->getStatusText();
    }

    /**
     * @param $statusText
     * @return $this
     */
    public function setStatusText($statusText)
    {
        $this->status->setStatusText($statusText);

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status->getStatusCode();
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->status->setStatusCode($statusCode);

        return $this;
    }

}