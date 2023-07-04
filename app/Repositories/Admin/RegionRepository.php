<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Region;

class RegionRepository
{
    private $region;
    public function __construct(Region $region)
    {
        $this->region = $region;
    }
    public function getRegionsWithPaginate($count, $filters)
    {
        $count = (int) $count;
        return $this->region->latest()->filter($filters)->paginate($count);
    }

    public function all()
    {
        return $this->region->all();
    }

    public function store($params)
    {
        return $this->region->create($params);
    }


    public function getById($id)
    {
        return $this->region->findOrFail($id);
    }

    public function update($id, $params)
    {
        $region = $this->getById($id);
        return $region->update($params);
    }

    public function delete($id)
    {
        $region = $this->getById($id);
        return $region->delete($id);
    }
}
