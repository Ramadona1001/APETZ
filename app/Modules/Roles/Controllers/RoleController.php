<?php

namespace Roles\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Roles\Repositories\RoleRepository;
use Roles\Requests\RoleRequest;

class RoleController extends Controller
{
    public $path;
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->path = 'Roles::';
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        hasPermissions('show_roles');
        $title = transWord('Roles');
        $pages = [
            [transWord('Roles'),'roles']
        ];
        $roles = $this->roleRepository->allData();
        return view($this->path.'index',compact('roles','pages','title'));
    }

    public function store(RoleRequest $request)
    {
        hasPermissions('create_roles');
        $role = $this->roleRepository->saveData($request,null);
        if($role == 'save') return redirect()->route('roles')->with('success','');
        elseif($role == 'already') return redirect()->route('roles')->with('fail','');
    }

    public function edit($id)
    {
        hasPermissions('update_roles');
        $id = Crypt::decrypt($id);
        $role = $this->roleRepository->getDataId($id);

        $title = transWord('Edit Role Data');
        $pages = [
            [transWord('Roles'),'roles'],
            [$role->name,['show_roles',Crypt::encrypt($role->id)]]
        ];
        return view($this->path.'.edit',compact('role','title','pages'));
    }

    public function update(RoleRequest $request,$id)
    {
        hasPermissions('update_roles');
        $id = Crypt::decrypt($id);
        $role = $this->roleRepository->saveData($request,$id);
        if($role == 'update') return redirect()->route('roles')->with('success','');
    }

    public function destroy($id){
        hasPermissions('delete_roles');
        $id = Crypt::decrypt($id);
        $this->roleRepository->deleteData($id);
        return back()->with('success','');
    }

    public function permissions($id)
    {
        hasPermissions('show_permissions');
        $id = Crypt::decrypt($id);
        $title = transWord('Assign Permissions');
        $pages = [
            [transWord('Roles'),'roles'],
            [transWord('Permissions'),'permissions']
        ];

        $permissionsName = $this->roleRepository->getPermissions($id)[0];
        $role = $this->roleRepository->getPermissions($id)[1];
        $permissions = $this->roleRepository->getPermissions($id)[2];
        $assignedPermissions = $this->roleRepository->getPermissions($id)[3];

        return view($this->path.'permissions',compact('permissionsName','role','permissions','assignedPermissions','pages','title'));
    }

    public function assignPermissions($id,Request $request)
    {
        hasPermissions('assign_permissions');
        $this->roleRepository->assignPermissions($id,$request);
    }
}
