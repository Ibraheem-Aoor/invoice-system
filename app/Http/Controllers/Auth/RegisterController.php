<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],$this->messages());
    }

    protected function messages()
    {
        return [
            'name.required' => 'الرجاء ادخال الإسم',
            'name.string' => 'الاسم يتكون من حروف وارقام',
            'name.max' => 'الاسم طويل جدا',
            'email.required' => 'الرجاء ادخال البريد الالكتروني',
            'email.string' => 'البريد الالكتروني غير صحيح',
            'email.unique' => 'البريد الالكتروني مجسل مسبقا',
            'password.required'=>'الرجاء ادخال كلمة المرور',
            'password.string'=>'الرجاء ادخال كلمة مرور صالحة',
            'password.min'=>'كلمة المرور تتكون من 8 حروف على الاقل',
            'password.confirmed'=>'كلمة المرور غير متطابقة',
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


}
