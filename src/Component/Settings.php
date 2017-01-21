<?php

namespace NutriCalc\Component;


class Settings
{
    private $env;

    public function __construct($env)
    {
        $this->env = $env;
    }

    public function setAllSettings()
    {
        switch ($this->env){
            case 'dev':
                $this->setDevSettings();
                break;
            case 'prod':
                $this->setProdSettings();
                break;
            default:
                throw new \Exception('Incorrect name for environment');
        }
    }

    public function getEnvironment()
    {
        return $this->env;
    }

    private function setProdSettings()
    {
        ini_set('display_errors', 0);
        error_reporting(0);
    }

    private function setDevSettings()
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }

}