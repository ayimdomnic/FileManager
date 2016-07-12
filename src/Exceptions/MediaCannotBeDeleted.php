<?php

namespace Ayim\Medialibrary\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Ayim\MediaLibrary\Media;

class MediaCannotBeDeleted extends Exception
{
    public static function doesNotBelongToModel(Media $media, Model $model)
    {
        $modelClass = get_class($model);

        return new static("Media with id {$media->getKey()} cannot be deleted because it does not belong to model {$modelClass} with id {$model->id}");
    }
}
