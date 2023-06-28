<?php

namespace App\Services\Admin;

use App\Helpers\PhotoUpload;
use App\Models\Store;
use App\Repositories\Admin\StoreRepository;

class StoreService
{
    private $storeRepository;
    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function get()
    {
        return $this->storeRepository->getStoresWithPaginate();
    }

    public function store($params,$file = null)
    {
        if($file){
         $path = PhotoUpload::upload($file);
         $params['image'] = $path;
        }
        return $this->storeRepository->store($params);
    }

    public function getById($id)
    {
        return $this->storeRepository->getById($id);
    }

    public function update($id, $params)
    {
        return $this->storeRepository->update($id, $params);
    }

    public function delete($id)
    {
        return $this->storeRepository->delete($id);
    }

    public function getMessage($text,$type)
    {
        return ['message'=>$text,'alert-type'=>$type];
    }

    public function ajaxResponse()
    {

    }
}
