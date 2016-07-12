<?php

namespace Ayim\MediaLibrary\Events;

use Illuminate\Queue\SerializesModels;
use Ayim\MediaLibrary\Media;

class MediaHasBeenAdded
{
    use SerializesModels;

    /**
     * @var \Ayim\MediaLibrary\Media
     */
    public $media;

    /*
     * @param \Ayim\MediaLibrary\Media $media
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }
}
