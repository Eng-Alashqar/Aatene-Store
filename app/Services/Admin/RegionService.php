<?php

namespace App\Services\Admin;

use App\Repositories\Admin\RegionRepository;
use App\Services\ServiceInterface;

class RegionService implements ServiceInterface
{
    private $regionRepository;
    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }


    public function get($count, $filters)
    {
        $count = (int) $count;
        return $this->regionRepository->getWithPaginate($count, $filters);
    }

    public function getAllRegions()
    {
        return $this->regionRepository->all();
    }

    public function store($params)
    {
        return $this->regionRepository->store($params);
    }


    public function getById($id)
    {
        return $this->regionRepository->getById($id);
    }

    public function update($id, $params)
    {
        return $this->regionRepository->update($id, $params);
    }

    public function delete($id)
    {
        return $this->regionRepository->delete($id);
    }
}
