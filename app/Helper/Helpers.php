<?php

if (!function_exists('uploadImage')) {
    function uploadImage($media, $path, $name)
    {
        $image = $media;
        $image_name = $name . '.' . $image->getClientOriginalExtension();
        $image->move($path, $image_name);
        return $image_name;
    }
}
