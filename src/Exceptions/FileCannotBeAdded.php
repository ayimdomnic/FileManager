<?php

namespace Ayim\MediaLibrary\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Ayim\MediaLibrary\Helpers\File;

class FileCannotBeAdded extends Exception
{
    //unknowtype exception
    public static function unknownType()
    {
        return new static('Only strings, FileObjects and UploadedFileObjects can be imported');
    }
    //Large file sizes Richard Hendricks should make the compression Algorithm opensource
    public static function fileIsTooBig(string $path)
    {
        $fileSize = File::getHumanReadableSize(filesize($path));

        $maxFileSize = File::getHumanReadableSize(config('laravel-medialibrary.max_file_size'));

        return new static("File `{$path}` has a size of {$fileSize} which is greater than the maximum allowed {$maxFileSize}");
    }
    //filedoen't exit
    public static function fileDoesNotExist(string $path)
    {
        return new static("File `{$path}` does not exist");
    }
    //unreachable Url
    public static function unreachableUrl(string $url)
    {
        return new static("Url `{$url}` cannot be reached");
    }
    //wrong location ..oops! filesystem disks
    public static function diskDoesNotExist(string $diskName)
    {
        return new static("There is no filesystem disk named `{$diskName}`");
    }

    public static function modelDoesNotExist(Model $model)
    {
        $modelClass = get_class($model);

        return new static("Before adding media to it, you should first save the $modelClass-model");
    }

    public static function requestDoesNotHaveFile($key)
    {
        return new static("The current request does not have a file in a key named `{$key}`");
    }
}
