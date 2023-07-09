<?php

namespace App\Services\Admin;

use App\Repositories\Admin\RoleRepository;
use App\Services\ServiceInterface;

class RoleService implements ServiceInterface
{
    private $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function get($count, $filters)
    {
        return $this->roleRepository->all();
    }


    public function store($params)
    {
        return $this->roleRepository->store($params);

    }

    public function getById($id)
    {
        return $this->roleRepository->getById($id);
    }

    public function getPermissions()
    {
        return $this->roleRepository->getPermissions();
    }

    public function getRolePermissions($id)
    {
        return $this->roleRepository->getRolePermissions($id);

    }
    public function update($id, $params)
    {
        return $this->roleRepository->update($id,$params);

    }

    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }

}
