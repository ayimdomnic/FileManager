<?php

namespace Ayim\Generator\Utils;

class FileUtil
{
    public static function createFile($path, $filename, $contents)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $path = $path.$filename;

        file_put_contents($path, $contents);
    }

    public static function createDirectoryIfNotExist($path, $replace = false)
    {
        if (file_exists($path) && $replace) {
            rmdir($path);
        }

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }

    public static function deleteFile($path, $filename)
    {
        if (file_exists($path.$filename)) {
            return unlink($path.$filename);
        }

        return false;
    }
}
