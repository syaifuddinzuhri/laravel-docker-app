<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ImageHandlerTrait
{
    public static function uploadImage($image, $path, $rekursif = true)
    {
        if ($image) {
            if (!is_dir($path)) {
                mkdir($path, 0755, $rekursif);
            }
            $imageName = time() . '.' . $image->extension();
            Image::make($image)->save($path . $imageName);
            return $imageName;
        }
    }

    public static function unlinkImage($path, $imageName)
    {
        $image = $path . $imageName;
        if (file_exists($image)) {
            @unlink($image);
        }
    }
}
