<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetails;
use App\User;

class OrderController extends Controller
{
    //
    public function all_order()
    {
        $order = Order::orderBy('CreateDate', 'DESC')->get();
        return view('admin.orderhistory.all_order')->with('orders', $order);
    }
    public function details($id)
    {
        $order_details = OrderDetails::where('order_id', $id)->get();
        $order = Order::where('order_id', $id)->first();
        $customer_id = $order->customer_id;
        $customer = User::find($customer_id);
        return view('admin.orderhistory.detail_order')->with('order_details', $order_details)->with('customer', $customer)->with('order', $order);
    }
    public function accept_order($id)
    {
        Order::where('order_id', $id)->update(['order_status'=>2]);
        return redirect()->back()->with('message', 'Đã xử lí đơn hàng');
    }
    public function cancel_order($id)
    {
        Order::where('order_id', $id)->update(['order_status'=> 0]);
        return redirect()->back()->with('message', 'Đã xử lí đơn hàng');
    }
}
