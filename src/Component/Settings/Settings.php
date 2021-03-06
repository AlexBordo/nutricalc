<?php

namespace NutriCalc\Component\Settings;


use NutriCalc\Component\Settings\Exception\SettingsException;

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

        ini_set('xdebug.var_display_max_depth', 5);
        ini_set('xdebug.var_display_max_children', 256);
        ini_set('xdebug.var_display_max_data', 1024);

        return true;
    }

}