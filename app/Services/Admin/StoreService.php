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

    public function get($filters)
    {
        return $this->storeRepository->getStoresWithPaginate(7,$filters);
    }

    public function getPendingStores()
    {
        return $this->storeRepository->getPendingStoresWithPaginate();
    }

    public function store($params)
    {
        // dd($params);
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

    public function acceptStore($id)
    {
        return $this->storeRepository->acceptStore($id);
    }

    public function delete($id)
    {
        return $this->storeRepository->delete($id);
    }
}
