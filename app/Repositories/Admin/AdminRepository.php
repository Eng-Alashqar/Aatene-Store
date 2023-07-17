<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\RepositoryInterface;

class AdminRepository implements RepositoryInterface
{
    public function __construct(private Admin $admin) {}

    public function getWithPaginate($count, $filters)
    {
        return $this->admin->exceptAuthUser()->latest()->paginate((int) $count);
    }

    public function getById($id)
    {
        return $this->admin->findOrFail($id);
    }

    public function store($params)
    {
        // dd($params);
        $admin =  $this->admin->create($params);
        $admin->storeImage($params['avatar'],$params['avatar_slug'],'avatar');
        foreach($params['role_name'] as $role){
            $admin->assignRole($role);
        }
        return $admin;
    }

    public function update($id, $params)
    {
        $admin = $this->getById($id);
        $admin->update($params);
        foreach($params['role_name'] as $role){
            $admin->assignRole($role);
        }
        return $admin;
    }

    public function delete($id)
    {
        $admin = $this->getById($id)->delete();
        return $admin;
    }



}
