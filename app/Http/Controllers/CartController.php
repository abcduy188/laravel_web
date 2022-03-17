<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

session_start();
class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
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
        return redirect()->back()->with('message', 'Cập nhật số lượng thất bại!!');
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
        return redirect('/trang-chu');
    }
    public function delete_cart_all()
    {
        $cart = session()->get('cart');
        if ($cart) {
            session()->forget('cart');
            return redirect('/trang-chu');
        }
        return redirect('/trang-chu');
    }
}
