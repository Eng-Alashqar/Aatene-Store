<?php

namespace App\Repositories\Admin;

use App\Models\Store;

class StoreRepository
{
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function getStoresWithPaginate($count = 7)
    {
        return $this->store->paginate($count);
    }

    public function store($params)
    {
        return $this->store->create($params);
    }

    public function getById($id)
    {
        return $this->store->first($id);
    }

    public function update($id, $params)
    {
        $store = $this->getById($id);
        return  $store->update($params);
    }

    public function delete($id)
    {
        $store = $this->getById($id);
        return $store->delete();
    }
}
