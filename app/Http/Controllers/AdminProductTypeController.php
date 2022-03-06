<?php

namespace App\Http\Controllers;

use App\Models\Product_type;
use Illuminate\Http\Request;

class AdminProductTypeController extends Controller
{
    //
    function list_product_type()
    {
        $product_types = Product_type::paginate(10);
        return view('admin.product.list_product_type', compact('product_types'));
    }

    function add_product_type()
    {
        return view('admin.product.add_product_type');
    }

    function store_product_type(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh loại sản phẩm',
            ],
        );

        // return $request->parent_id;
        Product_type::create([
            'name' => $request->input('name'),
        ]);
        return redirect('admin/product/list_product_type')->with('status', "Đã thêm loại sản phẩm thành công");
    }

    function delete_product_type($id)
    {
        Product_type::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect('admin/product/list_product_type')->with('status', 'Đã xóa loại sản phẩm thành công');
    }
}
