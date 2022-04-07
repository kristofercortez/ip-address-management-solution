<?php

namespace App\Exception;

use Exception;
use Throwable;

/**
 * Class InvalidFormErrorException
 * @package App\Exception
 */
class InvalidFormErrorException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Form data invalid", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}