<?php

namespace Ayim\MediaLibrary\UrlGenerator;

class S3UrlGenerator extends BaseUrlGenerator
{
    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getUrl() : string
    {
        return config('laravel-medialibrary.s3.domain').'/'.$this->getPathRelativeToRoot();
    //     if (!getUrl()) {
    //     	# code...
    //     	return invaldiUrl();
    //     }
    }

    public function invaldiUrl() :string
    {
    	return response()->message('this is an invalid Url');
    }
}
