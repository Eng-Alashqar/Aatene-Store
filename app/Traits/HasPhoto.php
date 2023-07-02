<?php

namespace App\Traits;
use App\Models\Photo;
trait HasPhoto
{
    public static function bootHasPhoto()
    {
        static::deleted(function ($model){
            $model->deleteImage();
        });
    }

    public function photo()
    {
        return $this->morphOne(Photo::class,'photoable');
    }

    public function storeImage($src,$slug,$type = 'photo')
    {
        return $this->photo()->create(['src'=>$src,'slug'=>$slug,'type'=>$type]);
    }

    public function updateImage($src,$slug,$type = 'photo')
    {
        $this->deleteImage();
        $this->storeImage($src,$slug,$type);
    }

    public function deleteImage()
    {
        if($this->photo()->count() >= 1)
        {
            foreach($this->photo()->get() as $photo){
                $photo->delete();
            }
        }
    }

    public function getImageAttribute()
    {
        $photo = $this->photo;

        if(!$photo)
        {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        return asset('storage/'.$photo->src);
    }
}
