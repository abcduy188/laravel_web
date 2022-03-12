<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Console;

//frontend
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');


//backend
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

//category product
Route::get('/admin/add-category-product', 'CategoryProductController@add_category_product');
Route::get('/admin/all-category-product', 'CategoryProductController@all_category_product');
Route::get('/admin/edit-category-product/{categoryproduct_id}', 'CategoryProductController@edit_category_product');
Route::get('/admin/delete-category-product/{categoryproduct_id}', 'CategoryProductController@delete_category_product');
Route::get('/admin/deleted-category-product', 'CategoryProductController@deleted_category_product');
// {categoryproduct_id} khai bao tuy y
Route::get('/admin/active-category-product/{categoryproduct_id}', 'CategoryProductController@active_category_product');
Route::get('/admin/unactive-category-product/{categoryproduct_id}', 'CategoryProductController@unactive_category_product');

Route::post('/admin/save-category-product', 'CategoryProductController@save_category_product');
Route::post('/admin/update-category-product/{categoryproduct_id}', 'CategoryProductController@update_category_product');



//product
Route::get('/admin/add-product', 'ProductController@add_product');
Route::get('/admin/all-product', 'ProductController@all_product');
Route::get('/admin/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/admin/delete-product/{product_id}', 'ProductController@delete_product');
Route::get('/admin/deleted-product', 'ProductController@deleted_product');
// {categoryproduct_id} khai bao tuy y
Route::get('/admin/active-product/{product_id}', 'ProductController@active_product');
Route::get('/admin/unactive-product/{product_id}', 'ProductController@unactive_product');

Route::post('/admin/save-product', 'ProductController@save_product');
Route::post('/admin/update-product/{product_id}', 'ProductController@update_product');

//user
Route::get('/admin/add-user', 'UserController@add_product');
Route::get('/admin/all-user', 'UserController@all_product');
Route::get('/admin/edit-user/{user_id}', 'UserController@edit_product');
Route::get('/admin/delete-user/{user_id}', 'UserController@delete_product');

//testupload
Route::get('upload', function () {
    return view('admin.testupload');
});

Route::post('upload', function (Request $request) {
    $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath(),[
        'folder'=>'test',
    ])->getSecurePath();
    dd($uploadedFileUrl);
});
