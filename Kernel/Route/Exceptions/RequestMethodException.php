<?php

namespace Kernel\Route\Exceptions;

class RequestMethodException extends \Exception
{
    const HTTP_ERROR_CODE = 400;
    const HTTP_ERROR_MESSAGE = 'Invalid request';

    public function __construct()
    {
        parent::__construct(self::HTTP_ERROR_MESSAGE, self::HTTP_ERROR_CODE);
    }
}