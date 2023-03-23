<?php

namespace Shitutech\Shareable\Exceptions;

final class SeException extends \Exception
{
    /**
     * {@inheritDoc}
     */
    public function __construct($message = '', $code = 1000, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}