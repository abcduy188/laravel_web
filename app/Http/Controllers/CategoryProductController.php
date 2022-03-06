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
    public function add_category_product()
    {
        return view('admin.categoryProduct.add_category_product');
    }
    public function all_category_product()
    {
        $all = DB::table('categoryproduct')->get();
        $manage_category_product = view('admin.categoryProduct.all_category_product')->with('all_category_product', $all);
        return view('admin_layout')->with('admin.categoryProduct.all_category_product', $manage_category_product);
    }
    public function save_category_product(Request $request)
    {
        $data = array();
        $isdelete = 0;
        // lay data theo name
        $data['CategoryName'] = $request->category_product_name;
        $data['SeoTitle'] = $request->category_product_seo;
        $data['Status'] = $request->category_product_status;
        $data['IsDelete'] = $isdelete;

        DB::table('categoryproduct')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/admin/add-category-product');
    }
    public function edit_category_product($id)
    {
        $edit_category = DB::table('categoryproduct')->where('ID', $id)->get();
        $manage_category_product = view('admin.categoryProduct.edit_category_product')->with('edit_category_product', $edit_category);
        return view('admin_layout')->with('admin.categoryProduct.edit_category_product', $manage_category_product);
    }
    public function update_category_product(Request $request, $id)
    {
        $data = array();

        // lay data theo name
        $data['CategoryName'] = $request->category_product_name;
        $data['SeoTitle'] = $request->category_product_seo;
        DB::table('categoryproduct')->where('ID', '=', $id)->update($data);
        session()->put('message', 'cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/admin/all-category-product');
    }
    public function delete_category_product($id)
    {
        $cate = DB::table('categoryproduct')->where('ID', '=', $id)->get();
        foreach ($cate as $item) {

            if ($item->IsDelete == 1) {
                DB::table('categoryproduct')->where('ID', '=', $id)->update(['IsDelete' => 0]);

                session()->put('message', 'Đã khôi phục danh mục');
            } else {
                DB::table('categoryproduct')->where('ID', '=', $id)->update(['IsDelete' => 1]);
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
    public function active_category_product($categoryproduct_id)
    {
        DB::table('categoryproduct')->where('ID', '=', $categoryproduct_id)->update(['Status' => 1, 'ModifiedBy' => 'duy']);
        session()->put('message', 'Đã hiển thị danh mục');
        return Redirect::to('/admin/all-category-product');
    }
    public function unactive_category_product($categoryproduct_id)
    {
        DB::table('categoryproduct')->where('ID', $categoryproduct_id)->update(['Status' => 0]);
        session()->put('message', 'Đã ẩn danh mục');
        return Redirect::to('/admin/all-category-product');
    }
}
