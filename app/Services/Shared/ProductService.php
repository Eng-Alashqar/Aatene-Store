<?php

namespace App\Services\Shared;

use App\Repositories\Shared\ProductRepository;

class ProductService
{
    private ProductRepository $productRepo;
    public function __construct(ProductRepository $productRepo){
        $this->productRepo = $productRepo;
    }

    public function get()
    {
        return $this->productRepo->getWithPaginate();
    }

    public function store($params)
    {
        return $this->productRepo->store($params);
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

    public function ajaxResponse()
    {
    }
}
