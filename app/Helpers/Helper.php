<?php

namespace App\Helpers;

class Helper
{
    public static function saveImage($image, $path)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/',$imageName);

        return $imageName;
    }
    public static function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}