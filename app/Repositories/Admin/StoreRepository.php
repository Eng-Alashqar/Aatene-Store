<?php

namespace App\Repositories\Admin;

use App\Models\Store;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

class StoreRepository implements RepositoryInterface
{

    public function __construct(private Store $store){}

    public function getWithPaginate($count = 7,$filters = null)
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

    public function getByUserId($id)
    {
        return $this->store->where('user_id',$id)->firstOrFail();
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
