<?php

namespace App\Services\Store;

use App\Helpers\PhotoUpload;
use App\Models\MultimediaHub\Tag;
use App\Models\Store\Product;
use App\Models\Store\Variant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductService
{

    private  $product;
    public function __construct()
    {
        $this->product =  new Product;
    }
    public function get()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        return $this->product->filter($filters)->with(['category', 'store'])->latest()->paginate($count == 0 ? 7 : $count);
    }

    public function getStoreRegions()
    {
        return  Auth::guard('seller')->user()->store->regions;
    }

    public function store($params)
    {
        $product =  $this->product->create($params);
        foreach (json_decode($params['files']) as $file) {
            $product->storeImage($file->photo, $file->photo_slug, 'cover');
        }

        if (array_key_exists('options', $params) && $params['options']) {
            foreach ($params['options'] as $option) {
             $attribute =   DB::table('attributes')->where('name',$option['attribute'])->first();
             foreach($option['options_value'] as $variant){
               $variant =  $product->variant()->create([
                    'name'=>$variant['value'],
                    'price'=>$variant['price']
                ]);
                $variant->attribute()->sync();
             }
            }
        }

        if (array_key_exists('image', $params) && is_file($params['image'])) {
            $file = $params['image'];
            $photo_obj['photo_slug'] = $file->getClientOriginalName();
            $photo_obj['photo'] = PhotoUpload::upload($file);
            $product->storeImage($photo_obj['photo'],  $photo_obj['photo_slug'], 'main');
        }

        if (array_key_exists('tags', $params) && $params['tags']) {
            $tags_ids = $this->createTags($params['tags']);
            $product->tags()->sync($tags_ids);
        }
        return $product;
    }

    public function createTags($params): array
    {
        $tags = json_decode($params);
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
    }


    public function getById($id)
    {
        return $this->product->findOrFail($id);
    }

    public function update($id, $params)
    {
        $product  = $this->getById($id);
        if (array_key_exists('files', $params)) {
            if ($product->photo()->count() >= 1) {
                foreach ($product->photo()->get() as $photo) {
                    $photo->delete();
                }
            }
            foreach (json_decode($params['files']) as $file) {
                $product->storeImage($file->photo, $file->photo_slug, 'cover');
            }
        }

        if (array_key_exists('options', $params) && $params['options']) {
            foreach ($product->options()->get() as $option) {
                $option->delete();
            }
            foreach ($params['options'] as $option) {
                $product->options()->create($option);
            }
        }

        if (array_key_exists('tags', $params) && $params['tags']) {
            $tags_ids = $this->createTags($params['tags']);
            $product->tags()->sync($tags_ids);
        }
        $product->update($params);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->getById($id)->delete();
        return $product;
    }


    public function upload($request)
    {
        $file = $request->file('files');
        $photo_obj['photo_slug'] = $file->getClientOriginalName();
        $photo_obj['photo'] = PhotoUpload::upload($file);
        return $photo_obj;
    }
}
