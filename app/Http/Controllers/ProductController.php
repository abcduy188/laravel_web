<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Contracts\Session\Session as SessionSession;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;

session_start();
class ProductController extends Controller
{
    //
    public function all_product()
    {

        $all = DB::table('product')
        ->join('categoryproduct','product.category_id','=','categoryproduct.ID') 
        ->select('product.*', 'categoryproduct.CategoryName')->get();

        // $all = DB::table('product')->get();
        
        $manage_product = view('admin.product.all_product')->with('all_product', $all);
        return view('admin_layout')->with('admin.all_product', $manage_product);
    }
    public function add_product()
    {
        $category = DB::table('categoryproduct')->orderby('ID', 'desc')->get();
        return view('admin.product.add_product')->with('category', $category);
    }
    public function save_product(Request $request)
    {
        $data = array();
        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath(),[
            'folder'=>'Laravel-Shop',
        ])->getSecurePath();
        $data['Image'] = $uploadedFileUrl;
        $isdelete = 0;
        $data['Name'] = $request->product_name;
        $data['SeoTitle'] = $request->product_seotitle;
        $data['Price'] = $request->product_price;
        $data['PromotionPrice'] = $request->product_promotionprice;
        $data['Description'] = $request->product_description;
        $data['Status'] = $request->product_status;
        $data['IsDelete'] = $isdelete;
        $data['category_id'] = $request->cateogryproduct_id;

        DB::table('product')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/admin/add-product');
    }
    public function edit_product($id)
    {
        
        $editproduct = DB::table('product')->where('ID','=',$id)->get();
        $category = DB::table('categoryproduct')->orderby('ID', 'desc')->get();
        $manage_product = view('admin.product.edit_product')->with('edit_product', $editproduct)->with('category',$category);
        return view('admin_layout')->with('admin.product.edit_product', $manage_product);
        
       
    }
    public function update_product(Request $request, $id)
    {

        $data = array();
        $img = $request->file('file');
        if($img)
        {
            $uploadedFileUrl = Cloudinary::upload($img->getRealPath(),[
                'folder'=>'Laravel-Shop',
            ])->getSecurePath();
            $data['Image'] = $uploadedFileUrl;
        }
        $isdelete = 0;
        $data['Name'] = $request->product_name;
        $data['SeoTitle'] = $request->product_seotitle;
        $data['Price'] = $request->product_price;
        $data['PromotionPrice'] = $request->product_promotionprice;
        $data['Description'] = $request->product_description;
        $data['Status'] = $request->product_status;
        $data['IsDelete'] = $isdelete;
        $data['category_id'] = $request->cateogryproduct_id;

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
                session()->put('message', 'Đã xóa danh mục');
            }
        }
        return Redirect::to('/admin/all-product');
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
