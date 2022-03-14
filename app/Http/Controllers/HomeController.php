<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('client.home');
    }
    // public function all_category_product()
    // {
    //     $all = CategoryProduct::all()->where('IsDelete', '=', 0);
    //     $manage_category_product = view('client.home')->with('all_category_product', $all);
    //     return view('layout')->with('client.home', $manage_category_product);
    // }
    public function category($seotitle ,$id)
    {

        $all= Product::all()->where('category_id', $id);
        
        dd($all);
    }
}
