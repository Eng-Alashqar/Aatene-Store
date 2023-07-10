<?php

namespace App\Repositories\Shared;

use App\Models\Product;
use App\Repositories\Shared\PanelRepository;

class ProductRepository implements PanelRepository
{
    public function __construct(private Product $product){}

    public function getWithPaginate($count = 7)
    {
        return $this->product->with(['category', 'store'])->paginate($count);
    }

    public function store($params)
    {
        $params['store_id'] = auth()->user()->id;
        $product = $this->product->create($params);
        // $product->storeImage($params['image'], $params['image_slug'], 'photo');
        return $product;
    }

    public function getById($id)
    {
        return $this->product->findORFail($id);
    }

    public function update($id, $params)
    {
        $product = $this->getById($id)->update((array) $params);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->getById($id)->delete();
        return $product;
    }
}
