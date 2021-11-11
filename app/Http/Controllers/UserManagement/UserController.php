<?php
namespace App\Http\Controllers\UserManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//custom Spatie\Permission
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\NewUserByAdmin;
use App\Notifications\NewUser;
class UserController extends Controller
{//start class

    public function __construct()
    {
        $this->middleware('permission:المستخدمين|قائمة المستخدمين', ['only' => ['index','store']]);
        $this->middleware('permission:اضافة مستخدم', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل مستخدم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مستخدم', ['only' => ['destroy']]);
        $this->middleware('permission: تفعيل مستخدم', ['only' => ['activateAccount']]);
        $this->middleware('permission: تعطيل مستخدم', ['only' => ['disableAccount']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return view('users.index' , compact('data'));
    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    public function store(NewUserByAdmin $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));
        $this->notifyAdmin($input['name']);
        return redirect()->route('users.index')
        ->with('Add','تم إنشاء المستخدم بنجاح');
    }
    public function show($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
        ->with('delete','تم حذف المستخدم بنجاح');
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'roles_name' => 'required',
        'status' => 'required',
        ]);
        $input = $request->all();   
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles_name'));//model has roles
        return redirect()->route('users.index')
        ->with('edit','تم تعديل المستخدم بنجاح');
    }
    // public function destroy($id)
    // {
    //     return dd($id);
    //     User::find($id)->delete();
    //     return redirect()->route('users.index')
    //     ->with('success','تم حذف المستخدم بنجاح');
    // }

    public function disableAccount($id)
    {
        $target = User::find($id);
        $target->update(['status' => 0]); //disabled
        session()->flash('disabled' , 'تم تعطيل حساب المستخدم');
        return redirect()->back();
    }

    public function activateAccount($id)
    {
        $target = User::find($id);
        $target->update(['status' => 1]); //Activated
        session()->flash('success' , 'تم تفعيل حساب المستخدم');
        return redirect()->back();
    }

    public function notifyAdmin($name)
    {
        $rolesWithUsers = Role::with('users')->where('name' , 'owner')->get();
        foreach($rolesWithUsers[0]->users as $i) //index = 0 becuase there is only one role with a owner name.
            $i->notify(new NewUser(array('تمت إضافة مستخدم جديد', $name)));
    }

}//End Class
