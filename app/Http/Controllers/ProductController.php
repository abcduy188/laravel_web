<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use Illuminate\Contracts\Session\Session as SessionSession;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    //
    public function all_product()
    {
        $all = DB::table('Product')->get();
        $manage_product = view('admin.all_product')->with('all_product', $all);
        return view('admin_layout')->with('admin.all_product', $manage_product);
    }
    public function add_product()
    {
        return view('admin.product.add_product');
    }
    public function save_product(Request $request)
    {
        $data = array();
        $isdelete = 0;
        // lay data theo name
        $data['Name'] = $request->product_name;
        
        $data['Description'] = $request->product_status;
        $data['IsDelete'] = $isdelete;

        DB::table('product')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/admin/add-category-product');
    }
    public function edit_product($id)
    {
        $edit_category = DB::table('product')->where('ID', $id)->get();
        $manage_product = view('admin.product.edit_product')->with('edit_product', $edit_category);
        return view('admin_layout')->with('admin.product.edit_product', $manage_product);
    }
    public function update_product(Request $request, $id)
    {
        $data = array();

        // lay data theo name
        $data['CategoryName'] = $request->product_name;

        DB::table('product')->where('ID', '=', $id)->update($data);
        session()->put('message', 'cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/admin/all-category-product');
    }
    public function delete_product($id)
    {
        $cate = DB::table('product')->where('ID', '=', $id)->get();
        foreach ($cate as $item) {

            if ($item->IsDelete == 1) {
                DB::table('product')->where('ID', '=', $id)->update(['IsDelete' => 0]);

                session()->put('message', 'Đã khôi phục danh mục');
            } else {
                DB::table('product')->where('ID', '=', $id)->update(['IsDelete' => 1]);
                $listproduct = DB::table('product')->where('category_id', $id)->get();
                foreach ($listproduct as $product) {
                    DB::table('product')
                        ->where('ID', $product->ID)
                        ->update(['IsDelete' => 1]);
                }
                session()->put('message', 'Đã xóa danh mục');
            }
        }
        return Redirect::to('/admin/all-category-product');
    }
    public function active_product($product_id)
    {
        DB::table('product')->where('ID', '=', $product_id)->update(['Status' => 1, 'ModifiedBy' => 'duy']);
        session()->put('message', 'Đã hiển thị danh mục');
        return Redirect::to('/admin/all-category-product');
    }
    public function unactive_product($product_id)
    {
        DB::table('product')->where('ID', $product_id)->update(['Status' => 0]);
        session()->put('message', 'Đã ẩn danh mục');
        return Redirect::to('/admin/all-category-product');
    }
}
