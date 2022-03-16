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
            
            $view->with('category' , $category);
        });
        //
        view()->composer('partial.cartpartial', function($view){
            $sess = session()->get('cart');
            $count = sizeof($sess);
            $total = 0;
            
            if($count> 0){
                foreach($sess as $item)
                {
                    $total+= $item['product_quantity']*$item['product_price'];
                }
                $view->with('total' , $total)->with('count', $count);
            }else{
                $view->with('total' , $total)->with('count', $count);
            }
           
            
           
        });
    }
}
