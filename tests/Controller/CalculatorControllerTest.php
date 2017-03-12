<?php

namespace NutriCalcTest\Controller;

class CalculatorControllerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function calculateAction()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', 'http://www.nutricalc.local/calc');

        $content = $res->getBody()->getContents();
        $contentObj = json_decode($content);

        $this->assertEquals(200, $res->getStatusCode());
        $this->assertObjectHasAttribute('status', $contentObj);
        $this->assertObjectHasAttribute('errors', $contentObj);
        $this->assertObjectHasAttribute('body', $contentObj);
    }
}