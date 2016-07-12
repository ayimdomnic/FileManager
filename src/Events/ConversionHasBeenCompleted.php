<?php

namespace Ayim\MediaLibrary\Events;

use Illuminate\Queue\SerializesModels;
use Ayim\MediaLibrary\Conversion\Conversion;
use Ayim\MediaLibrary\Media;

class ConversionHasBeenCompleted
{
    use SerializesModels;

    /**
     * @var \Ayim\MediaLibrary\Media
     */
    public $media;

    /**
     * @var \Ayim\MediaLibrary\Conversion\Conversion
     */
    public $conversion;

    /**
     * ConversionHasFinishedEvent constructor.
     *
     * @param \Ayim\MediaLibrary\Media                 $media
     * @param \Ayim\MediaLibrary\Conversion\Conversion $conversion
     */
    public function __construct(Media $media, Conversion $conversion)
    {
        $this->media = $media;
        $this->conversion = $conversion;
    }
}
