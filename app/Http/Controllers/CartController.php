<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetails;
use App\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

session_start();
class CartController extends Controller
{
    public function index()
    {
        return view('client.cart');
    }
    
    public function add_cart_ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $session_id = substr(md5(microtime()), rand(0, 25), 5); //random 0-25, lay 5 ki tu-> md5
            $cart = session()->get('cart');
            if ($cart == true) {
                $is_avaiable = 0;
                foreach ($cart as $item => $val) {
                    if ($val['product_id'] == $data['cart_id'])
                    {
                        $is_avaiable++;
                        $cart[$item]['product_quantity'] += 1; 
                        print_r( $cart[$item]['product_quantity']);
                    }
                       
                }
                session()->put('cart',$cart);
                session()->save();
                if ($is_avaiable == 0) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['cart_name'],
                        'product_id' => $data['cart_id'],
                        'product_image' => $data['cart_img'],
                        'product_quantity' => $data['cart_qty'],
                        'product_price' => $data['cart_price'],
                    );
                    session()->put('cart', $cart);
                    session()->save();
                }
            } else {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_name'],
                    'product_id' => $data['cart_id'],
                    'product_image' => $data['cart_img'],
                    'product_quantity' => $data['cart_qty'],
                    'product_price' => $data['cart_price'],
                );
                session()->put('cart', $cart);
                session()->save();
            }
           
        }
    }
    public function update_cart(Request $request)
    {
        $data = $request->all();

        $cart = session()->get('cart');

        foreach ($data['cart_qty'] as $value => $qty) {
            foreach ($cart as $item => $val) {
                if ($val['session_id'] == $value) {
                    $cart[$item]['product_quantity'] = $qty;
                }
            }
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('message', 'Cập nhật số lượng thành công!!');
    }
    public function delete_cart($id)
    {
        $cart = session()->get('cart');

        if ($cart == true) {
            foreach ($cart as $item) {
                if ($item['session_id'] == $id) {

                    unset($cart[array_search($item, $cart)]);
                }
            }
            session()->put('cart', $cart);
            return redirect()->back();
        }
        return redirect('/trang-chu')->with("message","Xóa sản phẩm thành công");
    }
    public function delete_cart_all()
    {
        $cart = session()->get('cart');
        if ($cart) {
            session()->forget('cart');
            return redirect('/trang-chu')->with("message","Xóa giỏ hàng thành công");
        }
        return redirect('/trang-chu');
    }
    public function checkout()
    {
        $cart = session()->get('cart');
        return view('client.checkout');
    }



    public function confirmorder(Request $request)
    {
        $order_code = substr(md5(microtime()),rand(0,26),5);
        $data = $request->all();
      
        $order = new Order();
        $order->customer_id = Auth::id();
        $order->shipping_name = $data['ship_name'];
        $order->shipping_address = $data['ship_address'];
        $order->shipping_phone= $data['ship_phone'];
        $order->shipping_email= $data['ship_email'];
        $order->shipping_type= $data['payment_option'];
        $order->order_note= $data['ship_note'];
        $order->CreateDate= Carbon::now('Asia/Ho_Chi_Minh');;
        $order->order_status= 1;
        $order->order_code = $order_code;
        $check= $order->save();
        if($check)
        {
            $orderde = Order::where('order_code','=', $order_code)->take(1)->first();
            if(session()->get('cart'))
            {
                foreach(session()->get('cart') as $key => $cart){
                    $order_detail = new OrderDetails();
                    $order_detail->order_id = $orderde->order_id ;
                    $order_detail->product_id= $cart['product_id'];
                    $order_detail->product_name=$cart['product_name'];
                    $order_detail->product_price=$cart['product_price']*$cart['product_quantity'];
                    $order_detail->product_sales_quantity=$cart['product_quantity'];
                    $order_detail->save();
                }
            }
            $cart = session()->get('cart');
            if ($cart) {
                session()->forget('cart');
                return redirect('/trang-chu')->with("message","Đặt hàng thành công");
            }
            return redirect('/trang-chu');
        }

       
    }
}
