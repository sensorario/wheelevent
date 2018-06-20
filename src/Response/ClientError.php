<?php

namespace Response;

class ClientError implements PubApi\GenericResponse
{
    private static $definition = [
        403 => 'Forbidden',
        404 => 'Not Found',
    ];

    private $httpStatusCode;

    public function __construct($httpStatusCode = 200)
    {
        $this->httpStatusCode = $httpStatusCode;
    }

    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    public function getContent()
    {
        return json_encode([
            'httpStatusCode' => $this->httpStatusCode,
            'success' => 'false',
            'definition' => self::$definition[$this->httpStatusCode],
        ]);
    }

    public function httpStatusCode()
    {
        return $this->httpStatusCode;
    }
}
