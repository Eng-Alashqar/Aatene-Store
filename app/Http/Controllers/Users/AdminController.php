<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AdminRequest;
use App\Services\AdminService;
use App\Services\RoleService;

class AdminController extends Controller
{
    private $adminService;
    private  $roleService;
    public function __construct() {
        $this->adminService = new AdminService;
        $this->roleService = new RoleService;
    }

    public function index()
    {
        $admins = $this->adminService->get();
        $roles = $this->roleService->all();
        return view('admin.admins.index', compact('admins','roles'));
    }


    public function create()
    {
        $roles = $this->roleService->all();
        return view('admin.admins.create',compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $this->adminService->store($request->validated());
        return back()->with(['notification'=>'تمت العملية بنجاح']);
    }

    public function show($id)
    {
        $admins = $this->adminService->getById($id);
        return view('admin.admins.show',compact('admins'));
    }

    public function edit($id)
    {
        $admin = $this->adminService->getById($id);
        $roles = $this->roleService->all();
        return view('admin.admins.edit',compact('admin','roles'));
    }

    public function update(AdminRequest $request, $id)
    {
        $this->adminService->update($id,$request->validated());
        return to_route('admin.admins.index')->with(['notification'=>'تمت العملية بنجاح']);
    }

    public function destroy($id)
    {
        $isDeleted = $this->adminService->delete($id);
        return  $this->deleteAjaxResponse($isDeleted);
    }
}
