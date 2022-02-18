<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use Illuminate\Contracts\Session\Session as SessionSession;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProductController extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $all = DB::table('tbl_category_product')->get()->where('category_delete','=',0);
        $manage_category_product = view('admin.all_category_product')->with('all_category_product',$all);
        return view('admin_layout')->with('admin.all_category_product',$manage_category_product);
    }
    public function save_category_product(Request $request){
        $data = array();
        $isdelete = 0;
        // lay data theo name
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        $data['category_delete'] = $isdelete;
        
        DB::table('tbl_category_product')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/admin/add-category-product');
    }
    public function edit_category_product($id){
        $edit_category = DB::table('tbl_category_product')->where('id',$id)->get();
        $manage_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category);
        return view('admin_layout')->with('admin.edit_category_product',$manage_category_product);
    }
    public function update_category_product(Request $request,$id){
        $data = array();
        
        // lay data theo name
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        
        DB::table('tbl_category_product')->where('id','=',$id)->update($data);
        session()->put('message', 'cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/admin/all-category-product');
    }
    public function delete_category_product($id)
    {
        DB::table('tbl_category_product')->where('id','=',$id)->update(['category_delete'=> 1, 'createby' => 'duy']);
        session()->put('message', 'Đã xóa danh mục');
        return Redirect::to('/admin/all-category-product');
    }
    public function active_category_product($categoryproduct_id){
        DB::table('tbl_category_product')->where('id','=',$categoryproduct_id)->update(['category_status'=> 1, 'createby' => 'duy']);
        session()->put('message', 'Đã hiển thị danh mục');
        return Redirect::to('/admin/all-category-product');
    }
    public function unactive_category_product($categoryproduct_id){
        DB::table('tbl_category_product')->where('id',$categoryproduct_id)->update(['category_status'=> 0]);
        session()->put('message', 'Đã ẩn danh mục');
        return Redirect::to('/admin/all-category-product');
    }
}
