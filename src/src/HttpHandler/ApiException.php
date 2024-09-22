<?php

namespace sadi01\openbanking\HttpHandler;

use yii\base\Exception;

class ApiException extends Exception
{
    public $statusCode;
    public $response;

    public function __construct($message, $statusCode = null, $response = null, $code = 0, Exception $previous = null)
    {
        $this->statusCode = $statusCode;
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    public function getName()
    {
        return 'API Exception';
    }
}

class NetworkException extends ApiException
{
    public function getName()
    {
        return 'Network Exception';
    }
}
