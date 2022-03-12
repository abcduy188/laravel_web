<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Void_;

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
        $result =DB::table('user')->where('Email',$admin_email)->first();  
          
        
        if($result)
        {
            if(Hash::check($request->admin_password, $result->Password))  {
                session()->put('admin_name', $result->Name);
                session()->put('admin_id', $result->ID);
                return Redirect::to('/dashboard');
            }
            else{
                session()->put('message','password not correct!!');
                return Redirect::to('/admin');
            }
           
        }else{
            session()->put('message','Email not correct!!');
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
