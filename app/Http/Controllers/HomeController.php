<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Product;
use App\Slides;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    //
    public function index()
    {
        $product = Product::orderBy('id', 'DESC')->take(6)->get();
        $slides = Slides::orderBy('id','DESC')->where('status',1)->get();
        return view('client.home')->with('product', $product)->with('slides', $slides);
    }
    public function category($seotitle, $id)
    {

        $all = Product::where('category_id', $id)->paginate(2);
        return view('client.category')->with('product', $all);
    }
    public function product($seotitle, $id)
    {
        $product = Product::find($id);
        $prorela = Product::where([['category_id', '=', $product->category_id], ['id', '<>', $product->id]])->get();
        return view('client.product')->with('product', $product)->with('prorela', $prorela);
    }
}
