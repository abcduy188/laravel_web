<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Void_;

session_start();

class AdminController extends Controller
{
    //
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id)
        {
            Redirect::to('admin.dashboard');

        }
        else{
           redirect('/login-index')->send();
        }
    }
    public function show_dashboard()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
        
    }

   
}
