<?php

namespace App\Exceptions;

use Exception;

class PaymentMethodDeletionException extends Exception
{
    /**
     * The exception property.
     *
     * @var Exception $exception
     */
    protected $exception;
    
    /**
     * PaymentMethodDeletionException constructor.
     *
     * @param Exception $e
     */
    public function __construct(Exception $e)
    {
        $this->exception = $e;
    }

    public function render()
    {
        return response($this->exception->getMessage(), 400);
    }
}
