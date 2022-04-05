<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            if(Auth::user()->hasAnyRoles(['ADMIN','mod'])) return redirect('/dashboard');
            return redirect('/trang-chu');
           
        } else {
            return redirect('/admin/login')->with('message', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function forgotPassword()
    {

        return view('auth.forget_pass');
    }
    public function sendcode(Request $request)
    {


        if ($request->has('Email')) {
            $user = User::where('email', $request->Email)->first();
            if ($user) {
                $code = substr(md5(microtime()), rand(0, 25), 5);
                $user->code = $code;
                $user->save();
                session()->put('user', $user);
                $to_name = "abcduy";
                $to_email = $user->email;

                $data = array(
                    "name" => "Test name",
                    "body" =>"Code của bạn là: ". $code
                );

                Mail::send('admin.user.resetpass', $data, function ($message) use ($to_name, $to_email) {
                    $message->to($to_email)->subject('Subject');
                    $message->from($to_email, $to_name);
                });

                return redirect()->back()->with('message', 'Vui lòng kiểm tra trong email của bạn');
            }
        } else {
            $user =  session()->get('user');
            if ($user->code == $request->code) {
                $pass = substr(md5(microtime()), rand(0, 25), 5);
                $user->password = Hash::make($pass);
                $user->code = null;
                $user->save();
                $to_name = "abcduy";
                $to_email = $user->mail;

                $data = array(
                    "name" => "Mật khẩu mới",
                    "body" => "Mật khẩu mới của bạn là: ".$pass
                );

                Mail::send('admin.user.resetpass', $data, function ($message) use ($to_name, $to_email) {
                    $message->to($to_email)->subject('Subject');
                    $message->from($to_email, $to_name);
                });
                session()->forget('user');
                return redirect('/admin/login')->with('message', 'Vui lòng đăng nhập lại');
            } else {
                dd('incorrect');
            }
        }

        return redirect()->back()->with('message', 'Email không tồn tại');
    }
}
