<?php

namespace Ayim\MediaLibrary\Exceptions;

use Exception;

class InvalidUrlGenerator extends Exception
{
    public static function doesntExist(string $class)
    {
        return new static("Class {$class} doesn't exist");
    }

    public static function isntAUrlGenerator(string $class)
    {
        return new static("Class {$class} must implement `Ayim\\MediaLibrary\\UrlGenerator\\UrlGenerator`");
    }
}
