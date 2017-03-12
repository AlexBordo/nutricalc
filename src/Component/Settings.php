<?php

namespace NutriCalc\Component;


use NutriCalc\Exception\SettingsException;

class Settings
{
    /**
     * @var string
     */
    private $env;

    public function __construct($env)
    {
        $this->env = $env;
    }

    /**
     * @throws \Exception
     */
    public function setAllSettings()
    {
        switch ($this->env){
            case 'dev':
                return $this->setDevSettings();
                break;
            case 'prod':
                return $this->setProdSettings();
                break;
            default:
                throw new SettingsException('Incorrect name for environment');
        }
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->env;
    }

    /**
     * @param string $env
     * @return $this
     */
    public function setEnvironment($env)
    {
        $this->env = $env;

        return $this;
    }

    /**
     * Sets settings for production environment
     */
    private function setProdSettings()
    {
        ini_set('display_errors', 0);
        error_reporting(0);

        return true;
    }

    /**
     * Sets settings for development environment
     */
    private function setDevSettings()
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        return true;
    }

}