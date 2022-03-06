<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Page;
use App\Models\Product_cat;
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
        Paginator::useBootstrap();

        view()->composer('*', function($view){
            $view->with([
                'pages' => Page::all(),
                'product_cats' => Product_cat::all(),
                'baners' => Banner::all(),
            ]);
        });

    }
}
