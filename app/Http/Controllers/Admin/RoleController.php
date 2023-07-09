<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    private $roleService;
    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }
    public function index()
    {
        $filters = request()->query();
        $count = request()->query('count');
        $roles = $this->roleService->get($count??10,$filters);
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
