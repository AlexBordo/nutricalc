<?php

namespace NutriCalc\Component\Response\Type;
use NutriCalc\Component\Response\Exception\ApiResponseException;

/**
 * Class ResponseStatusType
 */
class ResponseStatusType implements ResponseStatusTypeInterface
{
    const STATUS_TEXT_REGEX = '~^[a-zA-Z0-9]{1,24}$~';

    const STATUS_CODE_REGEX = '~^[0-9]{3}$~';

    /**
     * @var string
     */
    public $statusText;

    /**
     * @var int
     */
    public $statusCode;

    public function __construct($statusText, $statusCode)
    {
        if(!preg_match(self::STATUS_TEXT_REGEX, $statusText) || !preg_match(self::STATUS_CODE_REGEX, $statusCode)){
            throw new ApiResponseException('Invalid data provided');
        }

        $this->statusText = $statusText;
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getStatusText()
    {
        return $this->statusText;
    }

    /**
     * @param $statusText
     * @return $this
     * @throws ApiResponseException
     */
    public function setStatusText($statusText)
    {
        if(!preg_match(self::STATUS_TEXT_REGEX, $statusText)){
            throw new ApiResponseException('Invalid data provided');
        }

        $this->statusText = $statusText;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     * @throws ApiResponseException
     */
    public function setStatusCode($statusCode)
    {
        if(!preg_match(self::STATUS_CODE_REGEX, $statusCode)){
            throw new ApiResponseException('Invalid data provided');
        }

        $this->statusCode = $statusCode;

        return $this;
    }
}