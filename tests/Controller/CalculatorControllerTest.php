<?php

namespace NutriCalcTest\Controller;

class CalculatorControllerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function calculateAction()
    {
        // Commented out due to slow curl response, TODO: investigate and fix curl(local) slow issue
//        $client = new \GuzzleHttp\Client();
//        $res = $client->request('POST', 'http://www.nutricalc.dev/calc', ['curl' => [
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_CUSTOMREQUEST => true
//        ]]);
//
//        $content = $res->getBody()->getContents();
//        $contentObj = json_decode($content);
//
//        $this->assertEquals(200, $res->getStatusCode());
//        $this->assertObjectHasAttribute('status', $contentObj);
//        $this->assertObjectHasAttribute('errors', $contentObj);
//        $this->assertObjectHasAttribute('body', $contentObj);
    }
}