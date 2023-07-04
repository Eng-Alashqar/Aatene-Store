<?php

namespace App\Repositories\Admin;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreRepository
{
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function getStoresWithPaginate($count = 7,$filters = null)
    {
        return $this->store->latest()->accepted()->filter($filters)->paginate($count);
    }

    public function getPendingStoresWithPaginate($count = 10)
    {
        return $this->store->latest()->pending()->paginate($count);
    }

    public function store($params)
    {
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
        return  $store->update(['status'=>$params['status']]);
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
