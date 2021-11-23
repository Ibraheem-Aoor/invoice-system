<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{//start class

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('profile.profile-show' , compact('user'));
    }

    public function update(Request $request , $id)
    {
        $this->validateRequest($request , $id);
            $input = $request->all();
            $user = User::find($id);//obj
            if($input['password']== null)
            {
                $user->update([
                    'name' => $input['name'],
                    'email' => $input['email'],
                ]);
            }
            else
            {
                $user->update([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                ]);
            }
            $this->updateUserAvatar($request , $user);
            return redirect()->back()
            ->with(['updated'=>'تم تعديل المستخدم بنجاح']);
    }



    public function validateRequest(Request $request ,$id)
    {

        $request->validate( [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password|nullable',
            'avatar' => '|nullable|image',
            ],[
                'name.required'=>'الاسم مطلوب',
                'email.required'=>'الايميل مطلوب',
                'email.email'=>'الايميل غير صالح',
                // 'password.required'=>'كلمة المرور مطلوبة',
                'password.same'=>'كلمة المرور غير متطابقة',
                'avatar.image' => 'الصورة غير صالح',
            ]);
    }

    public function updateUserAvatar(Request $request , $user)
    {
        $userId = $user->id;
        if($request->hasFile('avatar'))
        {
            $avatarExt = $request->avatar->getClientOriginalExtension();
            $avatarName = time().'.'.$avatarExt;
            $image = $request->file('avatar');
            $newImage = Image::make($image->getRealPath())->resize(600,600);
            $path = public_path('/Avatars'.'/'.$avatarName);
            if(Auth::user()->avatar != null)
            {
                Storage::disk('public_avatars')->delete(Auth::user()->avatar);
                $newImage->save($path, 80);
            }
            else
            {
                $newImage->save($path, 80);
            }
            $user->avatar = $avatarName;
            $user->save();
        }
    }
}//End class
