<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException as SymfonyResourceNotFoundException;

class PetStoreException extends SymfonyResourceNotFoundException
{
    protected $errorCode;
    protected $errorMessage;

    public function __construct($message = "Resource not found", $code = Response::HTTP_NOT_FOUND)
    {
        parent::__construct($message, $code);
        $this->errorCode = $code;
        $this->errorMessage = $message;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
