<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Services\Admin\AdminService;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(private AdminService $adminService,private RoleService $roleService) {}
    public function index()
    {
        $filters = request()->query();
        $count = request()->query('count');
        $admins = $this->adminService->get($count??10,$filters);
        $roles = $this->roleService->get();

        return view('admin.admins.index', compact('admins','roles'));
    }


    public function create()
    {
        $roles = $this->roleService->get();
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
        $roles = $this->roleService->get();
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
