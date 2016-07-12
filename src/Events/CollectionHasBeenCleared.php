<?php

namespace Ayim\MediaLibrary\Events;

use Illuminate\Queue\SerializesModels;
use Ayim\MediaLibrary\HasMedia\Interfaces\HasMedia;

class CollectionHasBeenCleared
{
    use SerializesModels;

    /**
     * @var \Ayim\MediaLibrary\HasMedia\Interfaces\HasMedia
     */
    public $model;

    /**
     * @var string
     */
    public $collectionName;

    public function __construct(HasMedia $model, string $collectionName)
    {
        $this->model = $model;
        $this->collectionName = $collectionName;
    }
}
