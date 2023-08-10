<?php

namespace App\Services\Store;

use App\Helpers\PhotoUpload;
use App\Models\Store\Store;
use App\Repositories\Admin\StoreRepository;
use App\Services\ServiceInterface;

class StoreService
{
    private $store;
    public function __construct(){
        $this->store = new Store;
    }


    public function get()
    {
        $filters = request()->query();
        $count = (int) request()->query('count') ?? 7;
        return $this->store->latest()->accepted()->filter($filters)->paginate($count);
    }

    public function getPendingStores()
    {
        return $this->store->latest()->pending()->paginate(10);
    }

    public function store($params)
    {
        if($params['logo'] && $params['cover']){
            $params['logo_slug'] = $params['logo']->getClientOriginalName();
            $params['cover_slug'] = $params['cover']->getClientOriginalName();
            $params['logo'] = PhotoUpload::upload($params['logo']);
            $params['cover'] = PhotoUpload::upload($params['cover']);
        }
        $store =  $this->store->create($params);
        $store->storeImage($params['logo'],$params['logo_slug'],'logo');
        $store->storeImage($params['cover'],$params['cover_slug'],'cover');
        $store->regions()->sync($params['regions']);
        return $store;
    }

    public function getById($id)
    {
        return $this->store->findOrFail($id);
    }

    public function update($id, $params)
    {
        $store = $this->getById($id);
        return  $store->update([$params]);
    }

    public function acceptStore($id)
    {
        $store = $this->getById($id);
        return  $store->update(['is_accepted'=>true]);
    }

    public function delete($id)
    {
        $store = $this->getById($id);
        return $store->delete();
    }
}
