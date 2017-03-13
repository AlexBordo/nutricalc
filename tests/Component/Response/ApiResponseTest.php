<?php
namespace NutriCalcTest\ComponentTest;


use NutriCalc\Component\Response\ApiResponse;
use NutriCalc\Component\Response\Type\ResponseStatusType;
use NutriCalcTest\BaseTestCase;

/**
 * ApiSuccessResponseTest
 */
class ApiResponseTest extends BaseTestCase
{
    /**
     * @test
     */
    public function ApiResponseBuild()
    {
        $status = new ResponseStatusType('OK', 200);

        $response = new ApiResponse('body', $status, ['error1']);
        $this->assertEquals('OK', $response->getStatusText());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('body',$response->getResponseBody());
        $this->assertEquals(['error1'], $response->getErrors());
    }



}