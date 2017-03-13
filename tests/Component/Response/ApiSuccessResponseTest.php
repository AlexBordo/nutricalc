<?php
namespace NutriCalcTest\ComponentTest;

use NutriCalc\Component\Response\ApiSuccessResponse;
use NutriCalcTest\BaseTestCase;

/**
 * ApiSuccessResponseTest
 */
class ApiSuccessResponseTest extends BaseTestCase
{
    /**
     * @test
     */
    public function ApiSuccessResponseBuild()
    {
        $response = new ApiSuccessResponse();
        $this->assertEquals('OK', $response->getStatusText());
    }
}