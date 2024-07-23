<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\UserDetails;
class Helper
{
    public static function saveImage($image, $path)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $imageName);
        return $imageName;
    }
}