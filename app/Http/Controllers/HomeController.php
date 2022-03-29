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
        $product = Product::orderBy('id', 'DESC')->where('highlights','=','1')->take(6)->get();
        $productnew = Product::orderBy('id', 'DESC')->take(2)->get();
        $slides = Slides::orderBy('id','DESC')->where('status',1)->get();
        return view('client.home')->with('product', $product)->with('slides', $slides)->with('productnew', $productnew);
    }
    public function category($seotitle, $id)
    {

        $all = Product::where('category_id', $id)->paginate(2);
        $cate = CategoryProduct::find($id);
        return view('client.category')->with('product', $all)->with('cate',$cate);
    }
    public function product($seotitle, $id)
    {
        $product = Product::find($id);
        $prorela = Product::where([['category_id', '=', $product->category_id], ['id', '<>', $product->id]])->get();
        return view('client.product')->with('product', $product)->with('prorela', $prorela);
    }
}
