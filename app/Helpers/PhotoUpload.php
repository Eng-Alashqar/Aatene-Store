<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class PhotoUpload
{

    public static function upload($image, $dir = 'uploads', $disk = 'public')
    {
        $name = rand() . time() . $image->getClientOriginalName();
        $path = $image->storeAs("$dir", $name, $disk);
        return $path;
    }

    public function uploadImages($images, $dir, $disk = 'public')
    {
        $data_images = array();
        $x = 0;
        foreach ($images as $image) {
            $name = rand() . time() . $image->getClientOriginalName();
            $path = $image->storeAs("$dir", $name, $disk);
            $data_images[$x] = $path;
            $x++;
        }
        return $data_images;
    }
}
