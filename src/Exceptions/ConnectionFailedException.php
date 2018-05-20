<?php

namespace Puncoz\ServerDashboard\Exceptions;

/**
 * Class ConnectionFailedException
 * @package Puncoz\ServerDashboard\Exceptions
 */
class ConnectionFailedException extends \Exception
{
    const MESSAGE = 'Connection failed.';

    /**
     * ConnectionFailedException constructor.
     *
     * @param string $message
     */
    public function __construct($message = '')
    {
        $message = empty($message) ? self::MESSAGE : $message;

        parent::__construct($message);
    }
}
