<?php

namespace App\Providers;

use App\CategoryProduct;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('partial.category', function($view){
            $category = CategoryProduct::all()->where('IsDelete', '=', 0);
            $data = array(
                'category'=>array('cate 1', 'cate 2', 'cate3')
            );
            //dd($category);
            $view->with('category' , $category);
        });
    }
}
