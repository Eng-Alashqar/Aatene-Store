<?php

namespace App\Services\Store;

use App\Helpers\PhotoUpload;
use App\Models\Store\Product;
use App\Repositories\Shared\ProductRepository;

class ProductService
{

    private  $product;
    public function __construct(){
        $this->product =  new Product;
    }
    public function get()
    {
        $filters = request()->query();
        $count = (int) request()->query('count') ?? 7;
        return $this->product->with(['category', 'store'])->paginate($count);
    }

    public function store($params)
    {
        if ($params['image'] && is_file($params['image'])) {
            $params['image_slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }

        $product = $this->product->create($params);
         $product->storeImage($params['image'], $params['image_slug'], 'photo');
        return $product;
    }


    public function getById($id)
    {
        return $this->productRepo->getById($id);
    }

    public function update($id, $params)
    {
        return $this->productRepo->update($id, $params);
    }

    public function delete($id)
    {
        return $this->productRepo->delete($id);
    }

    public function getMessage($type, $message)
    {
        return ['type' => $type, 'message' => $message];
    }


}
