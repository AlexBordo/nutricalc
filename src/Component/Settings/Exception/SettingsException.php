<?php

namespace NutriCalc\Component\Settings\Exception;


class SettingsException extends \Exception
{
    public function errorMessage() {
        $errorMsg = 'Settings error';

        return empty($this->getMessage()) ? $errorMsg : $this->getMessage();
    }
}