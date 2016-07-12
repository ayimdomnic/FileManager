<?php

namespace Ayim\MediaLibrary\UrlGenerator;

use Illuminate\Contracts\Config\Repository as Config;
use Ayim\MediaLibrary\Conversion\Conversion;
use Ayim\MediaLibrary\Media;
use Ayim\MediaLibrary\PathGenerator\PathGenerator;

abstract class BaseUrlGenerator implements UrlGenerator
{
    /**
     * @var \Ayim\MediaLibrary\Media
     */
    protected $media;

    /**
     * @var \Ayim\MediaLibrary\Conversion\Conversion
     */
    protected $conversion;

    /**
     * @var \Ayim\MediaLibrary\PathGenerator\PathGenerator
     */
    protected $pathGenerator;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Ayim\MediaLibrary\Media $media
     *
     * @return \Ayim\MediaLibrary\UrlGenerator\UrlGenerator
     */
    public function setMedia(Media $media) : UrlGenerator
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @param \Ayim\MediaLibrary\Conversion\Conversion $conversion
     *
     * @return \Ayim\MediaLibrary\UrlGenerator\UrlGenerator
     */
    public function setConversion(Conversion $conversion) : UrlGenerator
    {
        $this->conversion = $conversion;

        return $this;
    }

    /**
     * @param \Ayim\MediaLibrary\PathGenerator\PathGenerator $pathGenerator
     *
     * @return \Ayim\MediaLibrary\UrlGenerator\UrlGenerator
     */
    public function setPathGenerator(PathGenerator $pathGenerator) : UrlGenerator
    {
        $this->pathGenerator = $pathGenerator;

        return $this;
    }

    /*
     * Get the path to the requested file relative to the root of the media directory.
     */
    public function getPathRelativeToRoot() : string
    {
        if (is_null($this->conversion)) {
            return $this->pathGenerator->getPath($this->media).$this->media->file_name;
        }

        return $this->pathGenerator->getPathForConversions($this->media)
        .$this->conversion->getName()
        .'.'
        .$this->conversion->getResultExtension($this->media->extension);
    }
}
