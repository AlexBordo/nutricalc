<?php
namespace NutriCalcTest\ComponentTest;

use NutriCalc\Component\Response\Type\ResponseStatusType;
use NutriCalcTest\BaseTestCase;

/**
 * ResponseStatusTypeTest
 */
class ResponseStatusTypeTest extends BaseTestCase
{
    /**
     * @test
     */
    public function ResponseStatusTypeBuild()
    {
        $status = new ResponseStatusType('OK', 200);

        $this->assertEquals('OK', $status->getStatusText());
        $this->assertEquals(200, $status->getStatusCode());
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Component\Response\Exception\ApiResponseException
     */
    public function ResponseStatusTypeBuildException()
    {
        $status = new ResponseStatusType('OK!', 2000);
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Component\Response\Exception\ApiResponseException
     */
    public function SetStatusTextException()
    {
        $status = new ResponseStatusType('OK', 200);
        $status->setStatusText('%^&** !^@£(&');
    }

    /**
     * @test
     *
     * @expectedException \NutriCalc\Component\Response\Exception\ApiResponseException
     */
    public function SetStatusCodeException()
    {
        $status = new ResponseStatusType('OK', 200);
        $status->setStatusCode("123d");
    }

    /**
     * @test
     */
    public function SetStatusTextMethod()
    {
        $status = new ResponseStatusType('OK', 200);
        $status->setStatusText('ERROR');
        $this->assertEquals('ERROR', $status->statusText);
    }

    /**
     * @test
     */
    public function SetStatusCodeMethod()
    {
        $status = new ResponseStatusType('OK', 200);
        $status->setStatusCode(404);
        $this->assertEquals(404, $status->statusCode);
    }
}