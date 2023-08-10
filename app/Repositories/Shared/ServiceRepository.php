<?php

namespace App\Repositories\Shared;

use App\Models\MultimediaHub\Service;

class ServiceRepository implements PanelRepository
{
    public function __construct(private Service $service){}

    public function getWithPaginate($count = 7)
    {
        return $this->service->with(['category', 'store'])->paginate($count);
    }

    public function store($params)
    {
        $params['store_id'] = auth()->user()->id;
        $service = $this->service->create($params);
        // $service->storeImage($params['image'], $params['image_slug'], 'photo');
        return $service;
    }

    public function getById($id)
    {
        return $this->service->findORFail($id);
    }

    public function update($id, $params)
    {
        $service = $this->getById($id)->update((array) $params);
        return $service;
    }

    public function delete($id)
    {
        $service = $this->getById($id)->delete();
        return $service;
    }
}
