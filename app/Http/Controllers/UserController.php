<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Roles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

session_start();
class UserController extends Controller
{
    public function all_product()
    {
        $all = DB::table('user')->get();
        $manage_product = view('admin.product.all_product')->with('all_product', $all);
        return view('admin_layout')->with('admin.all_product', $manage_product);
    }
    public function index()
    {
        $admin = User::with('roles')->orderBy('id', 'DESC')->get();
        return view('admin.user.all_user')->with(compact('admin'));
    }
    public function assign_roles(Request $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        $user->roles()->detach(); //go tat ca cac quyen ra
        if ($request['mod']) {
            $user->roles()->attach(Roles::where('role', 'MOD')->first());
        }
        if ($request['user']) {
            $user->roles()->attach(Roles::where('role', 'USER')->first());
        }
        if ($request['admin']) {
            $user->roles()->attach(Roles::where('role', 'ADMIN')->first());
        }
        return redirect()->back();
    }
    public function delete_user($id)
    {
        if(Auth::id()===$id) return redirect()->back()->with('message','Bạn không thể xóa chính mình');
        
        $user = User::find($id);
        if($user)
        {
            $user->roles()->detach();
            $user->delete();
            return redirect()->back()->with('message','Xóa User Thành công');
        }
        
        return redirect()->back()->with('message','Lỗi');
        
    }
    public function edit_user($id)
    {
        $editUser = User::find($id);
        $manage_product = view('admin.user.edit_user')->with('editUser', $editUser);
        return view('admin_layout')->with('admin.user.edit_user', $manage_product);
    }
    public function update_user(Request $request, $id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $data =  $request->all();
        $user = User::find($id);
        $user -> name = $data['name'];
        $user -> Phone = $data['phone'];
        $user->email = $data['email'];
        $user->ModifiedBy = Auth::user()->Name;
        $user->ModifiedDate = $date;
        $user->save();

        session()->put('message', 'cập nhật sản phẩm thành công');
        return Redirect::to('/admin/all-user');
    }

    //client
    public function info($id)
    {
        $user = User::find($id);
        $order = Order::where('customer_id',$id)->get();
        
        return view('client.user')->with('user', $user)->with('order',$order);
    }
    public function update(Request $request,$id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $user = User::find($id);
        $data = $request->all();
        $user->Name = $data['name'];
        $user->Phone = $data['phone'];
        $user->Address = $data['address'];
        $user->ModifiedDate = $date;
        $user->ModifiedBy = Auth::user()->Name;
        $user->save();
        return redirect()->back()->with("message","Cập nhật user thành công");
    }
    public function detail_order($id)
    {
    
        $order_details = OrderDetails::where('order_id', $id)->get();
        $order = Order::where('order_id', $id)->first();
        $customer_id = $order->customer_id;
        $customer = User::find($customer_id);
        return view('client.detail_order')->with('order_details', $order_details)->with('customer', $customer)->with('order', $order);
    }
    public function cancel_order($id)
    {
        Order::where('order_id', $id)->update(['order_status'=> 0]);
        return redirect()->back()->with('message', 'Đã xử lí đơn hàng');
    }
    public function changePass()
    {
        return view('client.changepassword');
    }
    public function dochangePass(Request $request)
    {
        $new= Hash::make($request['new']) ;
        $user = User::find(Auth::user()->id);
        if(Hash::check($request['old'],$user->password))
        {
           $user->password = $new;
           $user->save();
           return redirect()->back()->with('message','Đổi mật khẩu thành công');
        }
        
        return redirect()->back()->with('message','Mật khẩu cũ không đúng');
    }
}
