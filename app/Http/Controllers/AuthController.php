<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login')->with('message', 'Đã đăng xuất');
    }

    public function doRegister(Request $request)
    {
        $data = $request->all();
        $check = User::where('email', $data['register_email'])->first();

        if ($check) {
            return redirect('/register')->with('message', 'Email đã có người sử dụng');
        }

        $member = new User();
        $member->email = $data['register_email'];
        $member->Phone = $data['register_phone'];
        $member->Name = $data['register_name'];
        $member->password = Hash::make($data['register_password']);
        $member->Status = 1;
        $member->save();

        $member->roles()->attach(Roles::where('role', 'USER')->first());

        return redirect('/admin/login')->with('message', 'Đăng kí thành công');
    }
    public function login()
    {
        return view('auth.admin_login');
    }

    public function doLogin(Request $request)
    {
        $credentials = [
            'email' => $request['Email'],
            'password' => $request['Password'],
        ];
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            return redirect('/admin/login')->with('message', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }
}