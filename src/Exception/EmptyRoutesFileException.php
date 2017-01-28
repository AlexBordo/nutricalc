<?php

namespace NutriCalc\Exception;


class EmptyRoutesFileException extends \Exception
{
    public function errorMessage() {
        $errorMsg = 'No routes found or there are no routes set';

        return empty($this->getMessage()) ? $errorMsg : $this->getMessage();
    }
}