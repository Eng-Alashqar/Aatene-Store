<?php

namespace App\Observers;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoObserver
{
    /**
     * Handle the Photo "created" event.
     */
    public function creating(Photo $photo): void
    {
        //
    }

    /**
     * Handle the Photo "updated" event.
     */
    public function updated(Photo $photo): void
    {
        //
    }

    /**
     * Handle the Photo "deleted" event.
     */
    public function deleting(Photo $photo): void
    {
        $is_exist = Photo::where('src',$photo->src)->exists();
        if($is_exist){
            Storage::disk('s3')->delete($photo->src);
        }
    }


}
