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


use Illuminate\Support\Facades\Route;
//frontend
Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index' );


//backend
Route::get('/admin','AdminController@index' );
Route::get('/dashboard','AdminController@show_dashboard' );
Route::post('/admin-dashboard','AdminController@dashboard' );
Route::get('/logout','AdminController@logout' );

//category product
Route::get('/admin/add-category-product','CategoryProductController@add_category_product' );
Route::get('/admin/all-category-product','CategoryProductController@all_category_product' );
Route::post('/admin/save-category-product','CategoryProductController@save_category_product' );