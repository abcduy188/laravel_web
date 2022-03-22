<?php

namespace App\Providers;

use App\CategoryProduct;
use Illuminate\Pagination\Paginator;
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
        view()->composer('partial.category', function ($view) {
            $category = CategoryProduct::all()->where('IsDelete', '=', 0);
            $data = array(
                'category' => array('cate 1', 'cate 2', 'cate3')
            );

            $view->with('category', $category);
        });
        //
        view()->composer('partial.cartpartial', function ($view) {
            $sess = session()->get('cart');
            $total = 0;
            if ($sess) {
                $count = sizeof($sess);
                foreach ($sess as $item) {
                    $total += $item['product_quantity'] * $item['product_price'];
                }
                $view->with('total', $total)->with('count', $count);
            } else {
                $count = 0;
                $view->with('total', $total)->with('count', $count);
            }
        });
        Paginator::useBootstrap();
    }
}
