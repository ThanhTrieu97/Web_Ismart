<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    // function search(Request $request){

    //     $highlights = Product::where('name', 'LIKE', '%' . $request->get('searchQuest') . '%')->get();

    //     return json_encode($highlights);
    // }

    public function getSearch(Request $request)
    {
        // $sliders = Slider::all();
        $sellings = Product::where('selling_products', 2)->get();
        $pages = Page::all();
        $products = Product::where('name', 'LIKE','%'. $request->keyword.'%')
                            ->orWhere('price', $request->keyword)
                            ->get();
        return view('search', compact('products', 'pages', 'sellings'));
    }

    function getSearchAjax(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Product::where('name', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li  style="width: 400px">
                    <a style = "display: table; width: 100%; padding: 10px 15px; border-bottom: 1px solid #e8e8e8;" href="http://localhost:8080/unitop.vn/laravelpro/unimart/detail/product/' .$row->id . '">
                    <p style = "display: table-cell; vertical-align: top; width: 40px; height: 40px;">  <img style="width: 40px; height: 40px;" src="http://localhost:8080/unitop.vn/laravelpro/unimart/public/'.$row->thumbnail.'"></p>
                    <div style ="isplay: table-cell; vertical-align: top; padding-left: 10px;">
                    <h3 style = "font-weight: bold;">'.$row->name.'</h3>
                    <p style = "color: red;">'.number_format($row->price, 0, '', '.').'đ</p>
                    </div>
                    </a>
               ';
            }
            $output .= '</li>';
            echo $output;
            unset ($data);
        }
    }
}
