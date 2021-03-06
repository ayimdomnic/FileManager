<?php

namespace Ayim\MediaLibrary\Helpers;

use finfo;

class File
{
    /*
     * Rename a file.
     */
    public static function renameInDirectory(string $fileNameWithDirectory, string $newFileNameWithoutDirectory) : string
    {
        $targetFile = pathinfo($fileNameWithDirectory, PATHINFO_DIRNAME).'/'.$newFileNameWithoutDirectory;

        rename($fileNameWithDirectory, $targetFile);

        return $targetFile;
    }

    public static function getHumanReadableSize(int $sizeInBytes) : string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        if ($sizeInBytes == 0) {
            return '0 '.$units[1];
        }

        for ($i = 0; $sizeInBytes > 1024; ++$i) {
            $sizeInBytes /= 1024;
        }

        return round($sizeInBytes, 2).' '.$units[$i];
    }

    /*
     * Get the mime type of a file.
     */
    public static function getMimetype(string $path) : string
    {
        $finfo = new Finfo(FILEINFO_MIME_TYPE);

        return $finfo->file($path);
    }
    
    public static function getMimeForm(string $path) : string
    {
        $finfo = new Finfo(FILEINFO_MIME_TYPE);
        
        return $finfo->file($path);
    }
    
    //more mime attribbutes to be done 
}
