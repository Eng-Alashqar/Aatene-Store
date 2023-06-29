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

    public function store($params)
    {
        if($params['logo'] && $params['cover']){
            $params['logo_slug'] = $params['logo']->getClientOriginalName();
            $params['cover_slug'] = $params['cover']->getClientOriginalName();
            $params['logo'] = PhotoUpload::upload($params['logo']);
            $params['cover'] = PhotoUpload::upload($params['cover']);
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
