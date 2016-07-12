<?php

namespace Ayim\MediaLibrary\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ayim\MediaLibrary\Conversion\ConversionCollection;
use Ayim\MediaLibrary\FileManipulator;
use Ayim\MediaLibrary\Media;

class PerformConversions extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var \Ayim\MediaLibrary\Conversion\ConversionCollection
     */
    protected $conversions;

    /**
     * @var \Ayim\MediaLibrary\Media
     */
    protected $media;

    public function __construct(ConversionCollection $conversions, Media $media)
    {
        $this->conversions = $conversions;
        $this->media = $media;
    }

    public function handle() : bool
    {
        app(FileManipulator::class)->performConversions($this->conversions, $this->media);

        return true;
    }
}
