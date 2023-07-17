<?php

namespace App\Services\Admin;

use App\Helpers\PhotoUpload;
use App\Repositories\Admin\AdminRepository;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\Hash;

class AdminService implements ServiceInterface
{
    public function __construct(private AdminRepository $adminRepository, private RoleService $roleService)
    {
    }

    public function get($count, $filters)
    {
        return $this->adminRepository->getWithPaginate($count, $filters);
    }


    public function store($params)
    {
        if ($params['avatar']) {
            $params['avatar_slug'] = $params['avatar']->getClientOriginalName();
            $params['avatar'] = PhotoUpload::upload($params['avatar']);
        }
        $params['password'] = Hash::make($params['password']);
        foreach ($params['role_ids'] as $id) {
            $names[] = $this->roleService->getById($id)->name;
            $params['role_name'] = $names;
        }
        return $this->adminRepository->store($params);
    }

    public function getById($id)
    {
        return $this->adminRepository->getById($id);
    }


    public function update($id, $params)
    {
        foreach ($params['role_ids'] as $role_id) {
            $names[] = $this->roleService->getById($role_id)->name;
            $params['role_name'] = $names;
        }

        if(isset($params['password'])){
            $params['password'] = Hash::make($params['password']);
        }else{
            unset($params['password']);
        }
        return $this->adminRepository->update($id, $params);
    }


    public function delete($id)
    {
        return $this->adminRepository->delete($id);
    }
}
