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
        return view('admin.all_category_product');
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
}
