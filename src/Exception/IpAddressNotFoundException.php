<?php

namespace App\Exception;

use Exception;

/**
 * Class IpAddressNotFoundException
 * @package App\Exception
 */
class IpAddressNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'IP address not found!';
}
