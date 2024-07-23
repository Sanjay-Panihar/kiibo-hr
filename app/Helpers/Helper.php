<?php

namespace App\Helpers;

class Helper
{
    public static function saveImage($image, $path)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $imageName);
        return $imageName;
    }
}