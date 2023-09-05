<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class UniqueSlug
{
    public static function generateUniqueSlug($text): string
    {
        $user  = auth()->guard('seller')->user();
        return Str::slug($text).'-'.$user->store_id.'-'.date('is');
    }
}
