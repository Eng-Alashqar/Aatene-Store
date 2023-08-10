<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\RoleRequest;
use App\Services\RoleService;

class RoleController extends Controller
{
    private  $roleService;
    public function __construct() {
        $this->roleService = new RoleService;
    }
    public function index()
    {
        $roles = $this->roleService->all();
        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = $this->roleService->getPermissions();
        return view('admin.roles.create',compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->roleService->store($request->validated());
        return back()->with(['notification'=>'تمت العملية بنجاح']);
    }

    public function show($id)
    {
        $role = $this->roleService->getById($id);
        $permissions = $this->roleService->getPermissions();
        return view('admin.roles.show',compact('role','permissions'));
    }

    public function edit($id)
    {
        $role = $this->roleService->getById($id);
        $permissions = $this->roleService->getPermissions();
        $rolePermissions =$this->roleService->getRolePermissions($id)->pluck('id','id')->toArray();
        return view('admin.roles.edit',compact('role','permissions','rolePermissions'));
    }

    public function update(RoleRequest $request, $id)
    {
        $this->roleService->update($id,$request->validated());
        return to_route('admin.roles.index')->with(['notification'=>'تمت العملية بنجاح']);
    }

    public function destroy($id)
    {
        $isDeleted = $this->roleService->delete($id);
        return  $this->deleteAjaxResponse($isDeleted);
    }
}
