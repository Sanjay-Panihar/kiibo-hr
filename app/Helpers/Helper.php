<?php

namespace App\Helpers;

class Helper
{
    public static function saveImage($image, $path)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/', $imageName);

        return $imageName;
    }
    public static function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
    public static function generateTimeOptions()
    {
        $options = '';
        for ($hour = 1; $hour <= 12; $hour++) {
            foreach (['00', '15', '30', '45'] as $minute) {
                $options .= '<option value="' . $hour . ':' . $minute . '">' . $hour . ':' . $minute . '</option>';
            }
        }
        return $options;
    }
}