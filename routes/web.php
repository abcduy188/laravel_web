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

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//frontend
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
Route::get('/san-pham/{seotitle}/{id}', 'HomeController@category');
Route::get('/chi-tiet/{seotitle}/{id}', 'HomeController@product');
Route::get('/gio-hang', 'CartController@index')->middleware('auth');

//ajax
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::post('/update-cart', 'CartController@update_cart');
Route::get('/del-cart-ajax/{id}', 'CartController@delete_cart');
Route::group(['middleware' => 'auth.roles'], function () {

    //backend
    Route::get('/dashboard', 'AdminController@show_dashboard');


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
    Route::get('/admin/deleted-category-product', 'CategoryProductController@deleted_cateogory_product');
    //product
    Route::get('/admin/add-product', 'ProductController@add_product');
    Route::get('/admin/all-product', 'ProductController@all_product');
    Route::get('/admin/edit-product/{product_id}', 'ProductController@edit_product');

    Route::get('/admin/deleted-product', 'ProductController@deleted_product');
    // {categoryproduct_id} khai bao tuy y
    Route::get('/admin/active-product/{product_id}', 'ProductController@active_product');
    Route::get('/admin/unactive-product/{product_id}', 'ProductController@unactive_product');

    Route::post('/admin/save-product', 'ProductController@save_product');
    Route::post('/admin/update-product/{product_id}', 'ProductController@update_product');

    //user

    Route::get('/admin/all-user', 'UserController@index');
    Route::group(['middleware' => 'admin.role'], function () {
        Route::get('/admin/add-user', 'UserController@add_product');
        Route::get('/admin/edit-user/{user_id}', 'UserController@edit_user');
        Route::post('/admin/update-user/{user_id}', 'UserController@update_user');
        Route::get('/admin/delete-product/{product_id}', 'ProductController@delete_product');
        Route::post('/assign-roles', 'UserController@assign_roles');
        //Author

        Route::get('/admin/delete-user/{user_id}', 'UserController@delete_user');
    });
});


//Authentication
Route::get('/register', 'AuthController@register');
Route::post('/doregister', 'AuthController@doRegister');
Route::get('/admin/login', 'AuthController@login');
Route::post('/admin/dologin', 'AuthController@doLogin');
Route::get('/admin/logout', 'AuthController@logout');




//testupload
// Route::get('upload', function () {
//     return view('admin.testupload');
// });

// Route::post('upload', function (Request $request) {
//     $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath(),[
//         'folder'=>'test',
//     ])->getSecurePath();
//     dd($uploadedFileUrl);
// });
