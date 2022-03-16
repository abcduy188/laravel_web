<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use Illuminate\Contracts\Session\Session as SessionSession;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use App\CategoryProduct;

use Carbon\Carbon;

session_start();

class CategoryProductController extends Controller
{

    public function add_category_product()
    {
        return view('admin.categoryProduct.add_category_product');
    }
    public function all_category_product()
    {
        $all = CategoryProduct::all()->where('IsDelete', '=', 0);
        $manage_category_product = view('admin.categoryProduct.all_category_product')->with('all_category_product', $all);
        return view('admin_layout')->with('admin.categoryProduct.all_category_product', $manage_category_product);
    }
    public function deleted_category_product()
    {
        $all = CategoryProduct::all()->where('IsDelete', '=', 1);
        $manage_category_product = view('admin.categoryProduct.deleted_category_product')->with('all_category_product', $all);
        return view('admin_layout')->with('admin.categoryProduct.deleted_category_product_category_product', $manage_category_product);
    }
    public function save_category_product(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $isdelete = 0;
        $data = $request->all();


        $cate = new CategoryProduct();
        $cate->CategoryName = bcrypt($data['category_product_name']);
        $cate->SeoTitle = $data['category_product_seo'];
        $cate->Status = $data['category_product_status'];
        $cate->IsDelete = $isdelete;
        $cate->CreateBy = session()->get('admin_name');
        $cate->CreateDate = $date;
        $cate->save();
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/admin/add-category-product');
    }
    public function edit_category_product($id)
    {
        $edit_category = CategoryProduct::find($id);
        $manage_category_product = view('admin.categoryProduct.edit_category_product')->with('edit_category', $edit_category);
        return view('admin_layout')->with('admin.categoryProduct.edit_category_product', $manage_category_product);
    }
    public function update_category_product(Request $request, $id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');


        $data = $request->all();
        $cate = CategoryProduct::where('id', $id)->first();
        $cate->CategoryName = $data['category_product_name'];
        $cate->SeoTitle = $data['category_product_seo'];
        $cate->ModifiedDate = $date;
        $cate->ModifiedBy = session()->get('admin_name');
        $cate->save();

        session()->put('message', 'cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/admin/all-category-product');
    }
    public function delete_category_product($id)
    {
        $cate = CategoryProduct::where('id', $id)->first();

        if ($cate->IsDelete == 1) {
            $cate->IsDelete = 0;
            session()->put('message', 'Đã khôi phục danh mục');
        } else {
            $cate->IsDelete = 1;

            $product = $cate->products()->get();
            foreach ($product as $item) {
                $item->IsDelete = 1;
                $item->save();
            }
            session()->put('message', 'Đã xóa danh mục');
        }
        $cate->save();
        return Redirect::to('/admin/all-category-product');
    }
    public function active_category_product($categoryproduct_id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        CategoryProduct::where('id', $categoryproduct_id)->update([
            'Status' => 1, 'ModifiedBy' => session()->get('admin_name'),
            'ModifiedDate' => $date
        ]);

        session()->put('message', 'Đã hiển thị danh mục');
        return Redirect::to('/admin/all-category-product');
    }
    public function unactive_category_product($categoryproduct_id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        CategoryProduct::where('id', $categoryproduct_id)->update([
            'Status' => 0, 'ModifiedBy' => session()->get('admin_name'),
            'ModifiedDate' => $date
        ]);

        session()->put('message', 'Đã ẩn danh mục');
        return Redirect::to('/admin/all-category-product');
    }
    
}
