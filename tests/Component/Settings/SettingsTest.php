<?php
namespace NutriCalcTest\ComponentTest;

use NutriCalc\Component\Settings;
use NutriCalcTest\BaseTestCase;

/**
 * SettingsTest
 */
class SettingsTest extends BaseTestCase
{
    /**
     * @test
     */
    public function SettingsBuild()
    {
        $settings = new Settings('prod');

        $this->assertEquals('prod', $settings->getEnvironment());
    }

    /**
     * @test
     */
    public function SetAllSettingsProd()
    {
        $settings = new Settings('prod');

        $this->assertTrue($settings->setAllSettings());
    }

    /**
     * @test
     */
    public function SetAllSettingsDev()
    {
        $settings = new Settings('dev');

        $this->assertTrue($settings->setAllSettings());
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Exception\SettingsException
     */
    public function SetAllSettingsException()
    {
        $settings = new Settings('test');

        $settings->setAllSettings();
    }

    /**
     * @test
     */
    public function SetEnvironmentMethod()
    {
        $settings = new Settings('prod');
        $settings->setEnvironment('dev');

        $this->assertEquals('dev', $settings->getEnvironment());
    }
}