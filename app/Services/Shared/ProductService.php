<?php

namespace App\Services\Shared;

use App\Helpers\PhotoUpload;
use App\Repositories\Shared\ProductRepository;

class ProductService
{

    public function __construct(private ProductRepository $productRepo){}


    public function get()
    {
        return $this->productRepo->getWithPaginate();
    }

    public function store($params)
    {
        if ($params['image'] && is_file($params['image'])) {
            $params['image_slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }
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


}
