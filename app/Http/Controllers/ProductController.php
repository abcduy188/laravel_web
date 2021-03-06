<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requesets;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use Carbon\Carbon;

session_start();
class ProductController extends Controller
{
    //
    public function all_product()
    {

        $all = Product::where('IsDelete', '=', 0)
            ->with('category')->get();
        $manage_product = view('admin.product.all_product')
            ->with('all_product', $all);
        return view('admin_layout')
            ->with('admin.all_product', $manage_product);
    }
    public function deleted_product()
    {
        $all = Product::where('IsDelete', '=', 1)
            ->with('category')->get();
        $manage_product = view('admin.product.deleted_product')
            ->with('all_product', $all);
        return view('admin_layout')
            ->with('admin.deleted_product', $manage_product);
    }
    public function add_product()
    {
        $category = CategoryProduct::orderby('id', 'desc')->get();
        return view('admin.product.add_product')->with('category', $category);
    }
    public function save_product(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath(), [
            'folder' => 'Laravel-Shop',
        ])->getSecurePath();
        $isdelete = 0;
        $data = $request->all();



        $product = new Product();
        $product->Image = $uploadedFileUrl;
        $product->Name = $data['product_name'];
        $product->SeoTitle = $data['product_seotitle'];
        $product->Price = $data['product_price'];
        $product->PromotionPrice = $data['product_promotionprice'];
        $product->Description = $data['product_description'];
        $product->Status = $data['product_status'];
        $product->category_id = $data['cateogryproduct_id'];
        $product->IsDelete =  $isdelete;
        $product->highlights = $data['product_highlights'];
        $product->cpu = $data['product_cpu'];
        $product->vga = $data['product_vga'];
        $product->monitor = $data['product_monitor'];
        $product->CreateBy = session()->get('admin_name');
        $product->CreateDate = $date;
        $product->save();

        session()->put('message', 'Th??m s???n ph???m th??nh c??ng');
        return Redirect::to('/admin/add-product');
    }
    public function edit_product($id)
    {

        $editproduct = Product::find($id);
        $category = CategoryProduct::orderby('id', 'desc')->get();
        $manage_product = view('admin.product.edit_product')->with('edit_product', $editproduct)->with('category', $category);
        return view('admin_layout')->with('admin.product.edit_product', $manage_product);
    }
    public function update_product(Request $request, $id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $data =  $request->all();
        $img = $request->file('file');
        $product = Product::find($id);
        if ($img) {
            $uploadedFileUrl = Cloudinary::upload($img->getRealPath(), [
                'folder' => 'Laravel-Shop',
            ])->getSecurePath();
            $product->Image = $uploadedFileUrl;
        }

        $product->Name = $data['product_name'];
        $product->SeoTitle = $data['product_seotitle'];
        $product->Price = $data['product_price'];
        $product->PromotionPrice = $data['product_promotionprice'];
        $product->Description = $data['product_description'];
        $product->category_id = $data['cateogryproduct_id'];
        $product->cpu = $data['product_cpu'];
        $product->vga = $data['product_vga'];
        $product->monitor = $data['product_monitor'];
        $product->ModifiedBy = session()->get('admin_name');
        $product->ModifiedDate = $date;
        $product->save();

        session()->put('message', 'c???p nh???t s???n ph???m th??nh c??ng');
        return Redirect::to('/admin/all-product');
    }
    public function delete_product($id)
    {
        $item = Product::find($id);

        if ($item->IsDelete == 1) {
            $item->IsDelete = 0;
            session()->put('message', '???? kh??i ph???c S???n ph???m');
        } else {
            $item->IsDelete = 1;
            session()->put('message', '???? x??a S???n ph???m');
        }
        $item->save();
        return Redirect::to('/admin/all-product');
    }
    public function active_product($product_id)
    {
        Product::find($product_id)->update(['Status' => 1]);
        session()->put('message', '???? hi???n th??? s???n ph???m');
        return Redirect::to('/admin/all-product');
    }
    public function unactive_product($product_id)
    {
        Product::find($product_id)->update(['Status' => 0]);
        session()->put('message', '???? ???n s???n ph???m');
        return Redirect::to('/admin/all-product');
    }
    public function active_highlights($product_id)
    {
        Product::find($product_id)->update(['highlights' => 1]);
        session()->put('message', 'S???n ph???m ???? n???i b???t');
        return Redirect::to('/admin/all-product');
    }
    public function unactive_highlights($product_id)
    {
        Product::find($product_id)->update(['highlights' => 0]);
        session()->put('message', '???n n???i b???t s???n ph???m');
        return Redirect::to('/admin/all-product');
    }
}
