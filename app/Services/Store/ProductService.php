<?php

namespace App\Services\Store;

use App\Helpers\PhotoUpload;

use App\Models\Store\Product;
use App\Services\Store\Product\OptionsService;
use App\Services\Store\Product\TagsService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductService
{

    private $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function get()
    {
        $filters = request()->query();
        $count = (int)request()->query('count');
        return $this->product->filter($filters)->with(['category', 'store'])->latest()->paginate($count == 0 ? 7 : $count);
    }

    public function getStoreRegions()
    {
        return Auth::guard('seller')->user()->store->regions;
    }

    public function store($params)
    {

        DB::beginTransaction();

        try {
            $product = $this->product->create($params);
            foreach (json_decode($params['files']) as $file) {
                $product->storeImage($file->photo, $file->photo_slug, 'cover');
            }
            TagsService::createTags($params, $product);
            $this->storeMainImage($params, $product);
            OptionsService::createOptions($params, $product);
            foreach ($params['region'] as $key => $value) {
                $product->shippingAddressCost()->attach([$key => ['price' => $value]]);
            }
            DB::commit();
            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return false;
    }


    public function getById($id)
    {
        return $this->product->findOrFail($id);
    }

    public function update($id, $params)
    {
        DB::beginTransaction();
        try {
            $product = $this->getById($id);
            $product->update($params);
            if (array_key_exists('files', $params) && $params['files'] ) {
                $product->deleteImageByType('cover');
                foreach (json_decode($params['files']) as $file) {
                    $product->storeImage($file->photo, $file->photo_slug, 'cover');
                }
            }
            TagsService::createTags($params, $product);
            $this->storeMainImage($params, $product);
            OptionsService::editOptions($params, $product);
            foreach ($params['region'] as $key => $value) {
                $product->shippingAddressCost()->attach([$key => ['price' => $value]]);
            }
            DB::commit();
            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return false;
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


    public function storeMainImage($params, $product)
    {
        if (array_key_exists('image', $params) && is_file($params['image'])) {
            $file = $params['image'];
            $photo_obj['photo_slug'] = $file->getClientOriginalName();
            $photo_obj['photo'] = PhotoUpload::upload($file);
            $product->deleteImageByType('main');
            dd($photo_obj);
            $product->storeImage($photo_obj['photo'], $photo_obj['photo_slug'], 'main');
        }
    }


}
