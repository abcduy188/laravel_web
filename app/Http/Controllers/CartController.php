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
                foreach ($cart as $item) {
                    if ($item['product_id'] == $data['cart_id']) $is_avaiable++;
                }
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
            }
            session()->put('cart', $cart);
            session()->save();
        }
    }
    public function update_cart()
    {
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
    }
}
