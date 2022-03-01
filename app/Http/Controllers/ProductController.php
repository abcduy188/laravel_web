<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function all_category_product()
    {
        $all = DB::table('Product')->get();
        $manage_category_product = view('admin.all_category_product')->with('all_category_product', $all);
        return view('admin_layout')->with('admin.all_category_product', $manage_category_product);
    }
}
