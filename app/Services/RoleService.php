<?php

namespace App\Services;

use App\Repositories\Admin\RoleRepository;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService
{
    private  $role;
    private  $permission;
    public function __construct(){
        $this->role = new Role;
        $this->permission = new Permission;
    }

    public function all()
    {
        return $this->role->where('name','<>','الأدمن')->with(['users','permissions'])->get();
    }


    public function store($params)
    {
        DB::beginTransaction();
        $role = $this->role->create(['name' => $params['name'],'guard_name'=>'admin']);
        $created = $role->syncPermissions($params['permission_ids']);
        DB::commit();
        DB::rollback();
        return $created;
    }

    public function getById($id)
    {
        return $this->role->with(['users','permissions'])->findOrFail($id);
    }

    public function getPermissions()
    {
        return $this->permission->all();
    }

    public function getRolePermissions($id)
    {
        $rolePermissions = $this->permission->join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return $rolePermissions;
    }

    public function update($id, $params)
    {
        DB::beginTransaction();
        $role = $this->getById($id)->update(['name' => $params['name'],'guard_name'=>'admin']);
        $this->getById($id)->syncPermissions($params['permission_ids']);
        DB::commit();
        DB::rollback();
        return $role;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

}
