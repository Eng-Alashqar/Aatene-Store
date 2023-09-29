<?php

namespace App\Services;

use App\Helpers\PhotoUpload;
use App\Models\Users\Admin;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    private $model ;
    private  $roleService ;
    public function __construct()
    {
        $this->model = new Admin;
        $this->roleService = new RoleService;
    }

    public function get()
    {
        $filters = request()->query();
        $count = (int) request()->query('count') ?? 7;
        return $this->model->exceptAuthUser()->latest()->with(['permissions','roles','photo'])->paginate($count);
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
        $admin =  $this->model->create($params);
        $admin->storeImage($params['avatar'],$params['avatar_slug'],'avatar');
        foreach($params['role_name'] as $role){
            $admin->assignRole($role);
        }
        return $admin;
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
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

        $admin = $this->getById($id);
        $admin->update($params);
        foreach($params['role_name'] as $role){
            $admin->assignRole($role);
        }
        return $admin;
    }


    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}
