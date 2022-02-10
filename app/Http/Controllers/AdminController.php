<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use Illuminate\Contracts\Session\Session as SessionSession;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        $id=session()->get('admin_id');
        if($id!= null)
        {
            return view('admin.dashboard');
        }else{
            return view('admin');
        }
        
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result =DB::table('tbl_admin')->where('email',$admin_email)->where('password',$admin_password)->first();
        if($result)
        {
            session()->put('admin_name', $result->name);
            session()->put('admin_id', $result->id);
            return Redirect::to('/dashboard');
        }else{
            session()->put('message','Email or password not correct!!');
            return Redirect::to('/admin');
        }
         
    }
    public function logout()
    {
        session()->put('admin_name', null);
        session()->put('admin_id', null);
        return redirect('/admin');
    }
}