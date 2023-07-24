<?php

namespace App\Services\Shared;

use App\Helpers\PhotoUpload;
use App\Repositories\Shared\ServiceRepository;
use App\Services\ServiceInterface;

class TheService implements ServiceInterface
{
    private $serviceRepo;
    public function __construct(ServiceRepository $serviceRepo) {
        $this->serviceRepo = $serviceRepo;
    }

    public function get($count,$filters = null)
    {
        $count = (int) $count;
        return $this->serviceRepo->getWithPaginate($count,$filters);
    }

    public function store($params)
    {
        if($params['image'] && is_file($params['image'])){
            $params['slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }
        return $this->serviceRepo->store($params);
    }

    public function getById($id)
    {
        return $this->serviceRepo->getById($id);
    }

    public function update($id, $params)
    {
        if($params['image'] && is_file($params['image'])){
            $params['slug'] = $params['image']->getClientOriginalName();
            $params['image'] = PhotoUpload::upload($params['image']);
        }
        return $this->serviceRepo->update($id, $params);
    }

    public function delete($id)
    {
        return $this->serviceRepo->delete($id);
    }
}

