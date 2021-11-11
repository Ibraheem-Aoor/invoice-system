<?php
namespace App\Http\Controllers\UserManagement;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{//start class
    function __construct()
    {
        $this->middleware('permission:المستخدمين|قائمة المستخدمين|صلاحيات المستخدمين|', ['only' => ['index','store']]);
        $this->middleware('permission:اضافة صلاحية|', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('roles.index',compact('roles'));
    }
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission')); //many to many
        return redirect()->route('roles.index')
        ->with('Add','تم انشاء الصلاحية بنجاح');
    }
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();
        return view('roles.show',compact('role','rolePermissions'));
    }
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
        ->with('edit','تم تعديل الصلاحية بنجاح');
    }
    public function destroy($id)
    {

        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
        ->with('delete','تم حذف الصلاحية بنجاح');
    }



    

}//End class
