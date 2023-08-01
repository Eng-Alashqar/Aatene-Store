<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class PhotoUpload
{

    public static function upload($image, $dir = 'uploads', $disk = 'public')
    {
        $name =  time().'_'. $image->getClientOriginalName();
        $path = $image->storeAs("$dir", $name, $disk);
        return $path;
    }

    public function uploadImages($images, $dir, $disk = 'public')
    {
        $data_images = [];
        foreach ($images as $image) {
            $name = rand() . time() . $image->getClientOriginalName();
            $path = $image->storeAs("$dir", $name, $disk);
            $data_images[] = $path;
        }
        return $data_images;
    }
}
