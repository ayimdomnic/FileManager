<?php

namespace Ayim\MediaLibrary\UrlGenerator;

use Ayim\MediaLibrary\Conversion\Conversion;
use Ayim\MediaLibrary\Media;
use Ayim\MediaLibrary\PathGenerator\PathGenerator;

interface UrlGenerator
{
    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getUrl() : string;

    /**
     * @param \Ayim\MediaLibrary\Media $media
     *
     * @return \Ayim\MediaLibrary\UrlGenerator\UrlGenerator
     */
    public function setMedia(Media $media) : UrlGenerator;

    /**
     * @param \Ayim\MediaLibrary\Conversion\Conversion $conversion
     *
     * @return \Ayim\MediaLibrary\UrlGenerator\UrlGenerator
     */
    public function setConversion(Conversion $conversion) : UrlGenerator;

    /**
     * Set the path generator class.
     *
     * @param \Ayim\MediaLibrary\PathGenerator\PathGenerator $pathGenerator
     *
     * @return \Ayim\MediaLibrary\UrlGenerator\UrlGenerator
     */
    public function setPathGenerator(PathGenerator $pathGenerator) : UrlGenerator;
}
