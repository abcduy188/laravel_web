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
        $product = Product::orderBy('CreateDate')->take(6)->get();
        return view('client.home')->with('product', $product);
    }
    public function category($seotitle, $id)
    {

        $all = Product::all()->where('category_id', $id);
        return view('client.category')->with('product', $all);
    }
    public function product($seotitle, $id)
    {
        $product = Product::find($id);
        $prorela = Product::where([['category_id', '=', $product->category_id], ['id', '<>', $product->id]])->get();
        return view('client.product')->with('product', $product)->with('prorela', $prorela);
    }
}
