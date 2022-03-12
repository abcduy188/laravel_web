<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
session_start();
class UserController extends Controller
{
    public function all_product()
    {

        $all = DB::table('user')->get();

        // $all = DB::table('product')->get();
        
        $manage_product = view('admin.product.all_product')->with('all_product', $all);
        return view('admin_layout')->with('admin.all_product', $manage_product);

    }
}
