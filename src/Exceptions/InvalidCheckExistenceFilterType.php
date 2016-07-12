<?php

namespace Ayim\MediaLibrary\Exceptions;

use Exception;
use Ayim\MediaLibrary\Services\CheckExistence;

class InvalidCheckExistenceFilterType extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        if ($message === null) {
            $this->message = 'An invalid filter type was supplied. Valid options are: ' .
                implode(', ', CheckExistence::FILTERS);
        }
    }
}
