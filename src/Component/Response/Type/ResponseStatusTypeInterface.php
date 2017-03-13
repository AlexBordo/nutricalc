<?php

namespace NutriCalc\Component\Response\Type;


interface ResponseStatusTypeInterface
{
    public function getStatusText();

    public function setStatusText($statusText);

    public function getStatusCode();

    public function setStatusCode($statusCode);
}