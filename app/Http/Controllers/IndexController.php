<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Page;
use App\Models\Post;
use App\Models\Post_cat;
use App\Models\Product;
use App\Models\Product_cat;
use App\Models\Product_image;
use App\Models\Product_type;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    function show()
    {
        $sliders = Slider::all();
        $highlights = Product::where('status', 3)->get();
        // $product_type = Product_type::where('name', 'like', "%Điện thoại%")->get();
        // return $product_type;
        // return $product_type;
        $phones = Product::where('cat_id', 2)->paginate(8);
        $laptops = Product::where('cat_id', 3)->get();
        // $product_cats = Product_cat::all();
        // return $phones;
        $sellings = Product::where('selling_products', 2)->get();
        return view('index', compact('sliders', 'highlights', 'phones', 'sellings', 'laptops'));
    }

    function detailProduct(Request $request, $id)
    {
        $products = Product::find($id);
        $id_product = $request->id;
        // return $id_image;
        $product_images = Product_image::where('product_id', $id_product)->get();

        $same_category = Product::where('product_cat', $products->product_cat)->get();
        $sellings = Product::where('selling_products', 2)->get();
        // dd($same_category);
        // return $product_image;
        return view('detail_product.show', compact('products', 'product_images', 'same_category', 'sellings'));
    }

    // function list_product($id, Request $request)
    // {
    //     // $id_product_cat = $request->id;
    //     //     $list = Product::where('product_cat', $id_product_cat)->orWhere('product_cat', 'product_cat_id->prarent_di')->get();
    //     //    dd($list);
    //     // $list = Product_cat::with(['product', 'child.parent'])->where('id', $id_product_cat)->get();
    //     // echo "<pre>";
    //     // print_r($list);
    //     // echo "</pre>";

    //     $list_product = Product_cat::where('id', $id)->first();
    //     $list_product_type = Product_type::where('name', $list_product->name)->first();
    //     // $data = DB::table('product_cats')->select('parent_id')->get();
    //     $list_products = Product_cat::all()->first();
    // //    return $list_products;
    //     // $value = DB::table('products')->select('product_cat')->get();



    //     // dd($list_product);
    //     $product = Product::where('product_cat', $list_product->id,)->paginate(10);

    //     // $product = Product::join('product_cats', );
    //     // return $product;
    //     $phones = Product::where('cat_id', 2)->paginate(8);
    //     return view('frontend.category_product', compact('product', 'list_product', 'phones'));
    // }



    function list_product(Request $request, $id){
        $list = Product_cat::where('id', $id)->first();
        $list_product_type = Product_type::where('name', $list->name)->first();
        $product = Product::where('product_cat', $id)->paginate(10);
        $count = Product::where('product_cat', $id)->count();
        $sellings = Product::where('selling_products', 2)->get();
        return view('frontend.category_product', compact('product', 'list', 'count', 'sellings'));
    }

    function all_product(Request $request,$cat_id){
        $cat_name = Product_cat::where('cat_id', $cat_id)->first();

        $cat = $request->cat_id;
        // return $cat;
        $sellings = Product::where('selling_products', 2)->get();
        $all_product = Product::where('cat_id', $cat)->paginate(10);
        $count = Product::where('cat_id', $cat)->count();
        // return $all_product;
        // return $baners;
        return view('frontend.all_category_product', compact('all_product', 'cat_name', 'count', 'sellings'));
    }

    function post(Request $request, $id){
        $sellings = Product::where('selling_products', 2)->get();
        $list_page = Page::find($id);
        $page_name = $list_page->name;
        $id_page = $request->id;
        // return $id_page;
        $posts = Post::where('page_id', $id_page)->paginate(10);
        // return $posts;
        return view('frontend.list_post', compact('posts', 'page_name', 'sellings'));
    }

    function detailpost(Request $request, $id){
        $id_post = $request->id;
        $sellings = Product::where('selling_products', 2)->get();
        $posts = Post::find($id);
        return view('frontend.post', compact('posts', 'sellings'));
    }

    function contact(){
        $sellings = Product::where('selling_products', 2)->get();
        return view('frontend.contact', compact('sellings'));
    }
}
