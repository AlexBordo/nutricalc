<?php
namespace NutriCalcTest\ComponentTest;

use NutriCalc\Component\Response\ApiErrorResponse;
use NutriCalcTest\BaseTestCase;

/**
 * ApiSuccessErrorTest
 */
class ApiSuccessErrorTest extends BaseTestCase
{
    /**
     * @test
     */
    public function ApiSuccessResponseBuild()
    {
        $response = new ApiErrorResponse();
        $this->assertEquals('ERROR', $response->getStatusText());
    }
}