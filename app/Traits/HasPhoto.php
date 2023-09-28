<?php

namespace App\Traits;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

trait HasPhoto
{


    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, ['ImagesWithType', 'Images', 'Image']));

        return parent::getArrayableAppends();
    }


    protected function getArrayableItems(array $values)
    {
        if (!in_array('photo', $this->hidden)) {
            $this->hidden[] = 'photo';
        }
        return parent::getArrayableItems($values);
    }

    public static function bootHasPhoto()
    {
        static::deleted(function ($model) {
            $model->deleteImage();
        });
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function storeImage($src, $slug, $type = 'photo'): \Illuminate\Database\Eloquent\Model
    {
        return $this->photo()->create(['src' => $src, 'slug' => $slug, 'type' => $type]);
    }

    public function updateImage($src, $slug, $type = 'photo'): void
    {
        $this->deleteImage();
        $this->storeImage($src, $slug, $type);
    }

    public function deleteImage(): void
    {
        if ($this->photo()->count() >= 1) {
            foreach ($this->photo()->get() as $photo) {
                $photo->delete();
            }
        }
    }

    public function deleteImageByType($type): void
    {
        if ($this->photo()->count() >= 1) {
            foreach ($this->photo()->where('type', $type)->get() ?? [] as $photo) {
                $photo->delete();
            }
        }
    }

    public function getImageAttribute()
    {
        $photo = $this->photo;
        if (!$photo) {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        $url = Storage::disk('s3')->temporaryUrl($photo->src, now()->minutes(120));
        return $url;
    }



    public function getImagesAttribute()
    {
        $photo = $this->photo()->get();
        if (!$photo) {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        $url = [];
        foreach ($photo as $image) {
            $url[] = Storage::disk('s3')->temporaryUrl($image->src, now()->minutes(3600));
        }
        return $url;
    }

    public function getImagesWithTypeAttribute(): array|string
    {
        $photo = $this->photo()->get();
        if (!$photo) {
            return 'https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        $images = [];
        foreach ($photo as $image) {
            $images[] =
                [
                    'url' => Storage::disk('s3')->temporaryUrl($image->src, now()->minutes(120)),
                    'type' => $image->type
                ];
        }
        return $images;
    }
}
