<?php

namespace Ayim\MediaLibrary\UrlGenerator;

use Ayim\MediaLibrary\Exceptions\InvalidUrlGenerator;
use Ayim\MediaLibrary\Media;
use Ayim\MediaLibrary\PathGenerator\PathGeneratorFactory;

class UrlGeneratorFactory
{
    public static function createForMedia(Media $media) : UrlGenerator
    {
        $urlGeneratorClass = config('laravel-medialibrary.custom_url_generator_class')
            ?: 'Ayim\MediaLibrary\UrlGenerator\\'.ucfirst($media->getDiskDriverName()).'UrlGenerator';

        static::guardAgainstInvalidUrlGenerator($urlGeneratorClass);

        $urlGenerator = app($urlGeneratorClass);
        $pathGenerator = PathGeneratorFactory::create();

        $urlGenerator->setMedia($media)->setPathGenerator($pathGenerator);

        return $urlGenerator;
    }

    public static function guardAgainstInvalidUrlGenerator(string $urlGeneratorClass)
    {
        if (!class_exists($urlGeneratorClass)) {
            throw InvalidUrlGenerator::doesntExist($urlGeneratorClass);
        }

        if (!is_subclass_of($urlGeneratorClass, UrlGenerator::class)) {
            throw InvalidUrlGenerator::isntAUrlGenerator($urlGeneratorClass);
        }
    }
}
