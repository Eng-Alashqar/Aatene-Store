<?php

namespace App\Repositories\Shared;

use App\Models\Store\Product;
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
        $product = $this->product->create($params);
        return $product;
    }

    public function getById($id)
    {
        return $this->product->first($id);
    }

    public function update($id, $params)
    {
        $product = $this->getById($id)->update($params);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->getById($id)->delete();
        return $product;
    }
}
