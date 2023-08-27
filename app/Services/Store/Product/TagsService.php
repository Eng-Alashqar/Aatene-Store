<?php

namespace App\Services\Store\Product;

use App\Models\MultimediaHub\Tag;
use Illuminate\Support\Str;

class TagsService
{

    public static function createTags($params, $product): array
    {
        if (array_key_exists('tags', $params) && $params['tags']) {
            $tags = json_decode($params['tags']);
            $tags_ids = [];
            $saved_tags = Tag::all();
            foreach ($tags as $i) {
                $slug = Str::slug($i->value, '-', 'ar');
                $tag = $saved_tags->where('slug', $slug)->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $i->value,
                        'slug' => $slug
                    ]);
                }
                $tags_ids[] = $tag->id;
            }
            return $tags_ids;

            $product->tags()->sync($tags_ids);
        }
    }
}
