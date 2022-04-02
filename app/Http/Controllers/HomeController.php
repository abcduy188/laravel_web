<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Product;
use App\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    //
    public function index()
    {
        $product = Product::orderBy('id', 'DESC')->where([['highlights','=','1'],['IsDelete','=',0],['Status','=',1]])->take(6)->get();
        $productnew = Product::orderBy('id', 'DESC')->where([['IsDelete','=',0],['Status','=',1]])->take(2)->get();
        $slides = Slides::orderBy('id','DESC')->where('status',1)->get();
        return view('client.home')->with('product', $product)->with('slides', $slides)->with('productnew', $productnew);
    }
    public function category($seotitle, $id)
    {

        $all = Product::where('category_id', $id)->paginate(3);
        $cate = CategoryProduct::find($id);
        return view('client.category')->with('product', $all)->with('cate',$cate);
    }
    public function product($seotitle, $id)
    {
        $product = Product::find($id);
        $prorela = Product::where([['category_id', '=', $product->category_id], ['id', '<>', $product->id]])->get();
        return view('client.product')->with('product', $product)->with('prorela', $prorela);
    }
    public function doSearch(Request $request)
    {   
       
        $name = $request->query('search');
        $product = Product::where('Name','like','%'.$name.'%')->get();
        return view('client.search')->with('product', $product);
    }
    public function sendmail()
    {
        $to_name = "abcduy";
        $to_email = "trkhanhsduy@gmail.com";

        $data = array("name"=>"Test name","body"=>"test body");

        Mail::send('admin.user.resetpass',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Subject');
            $message->from($to_email,$to_name);
        });


        return redirect()->action('HomeController@index')->with("message","DDax redirect");
    }
   
}
