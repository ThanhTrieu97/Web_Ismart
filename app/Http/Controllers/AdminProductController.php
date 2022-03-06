<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_cat;
use App\Models\Product_image;
use App\Models\Product_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class AdminProductController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'product',
            ]);
            return $next($request);
        });
    }

    function list(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời',
            'out_stock' => 'Hết hàng',
            'stocking' => 'Còn hàng',
            'highlights' => 'Nổi bật',
        ];
        if ($status != "") {
            if ($status == 'trash') {
                $list_act = [
                    'restore' => 'Khôi phục',
                    'forceDelete' => 'Xóa vỉnh viển',
                ];
                $products = Product::onlyTrashed()->paginate(10);
            }

            if ($status == 'all') {
                $list_act = [
                    'delete' => 'Xóa tạm thời',
                    'restore' => 'Khôi phục',
                    'forceDelete' => 'Xóa vỉnh viển',
                    'out_stock' => 'Hết hàng',
                    'stocking' => 'Còn hàng',
                    'highlights' => 'Nổi bật',
                ];
                $products = Product::withTrashed()->paginate(10);
            }
            if ($status == 'stocking') {
                $list_act = [
                    'out_stock' => 'Hết hàng',
                    'highlights' => 'Nổi bật',
                ];
                $products = Product::where('status', 2)->paginate(10);
            }
            if ($status == 'out_stock') {
                $list_act = [
                    'stocking' => 'Còn hàng',
                    'highlights' => 'Nổi bật',
                ];
                $products = Product::where('status', 1)->paginate(10);
            }
            if ($status == 'highlights') {
                $list_act = [
                    'stocking' => 'Còn hàng',
                    'out_stock' => 'Hết hàng',
                ];
                $products = Product::where('status', 3)->paginate(10);
            }
            if ($status == 'normal') {
                $list_act = [
                    'selling' => 'Bán chạy',
                ];
                $products = Product::where('selling_products', 1)->paginate(10);
            }
            if ($status == 'selling') {
                $list_act = [
                    'normal' => 'Bình thường',
                ];
                $products = Product::where('selling_products', 2)->paginate(10);
            }

        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $products = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        }

        $count_product_active = Product::count();
        $count_product_trash = Product::onlyTrashed()->count();
        $count_product_all = Product::withTrashed()->count();
        $count_product_stocking = Product::where('status', 2)->count();
        $count_product_out_stock = Product::where('status', 1)->count();
        $count_product_highlights = Product::where('status', 3)->count();
        $count_product_normal = Product::where('selling_products', 1)->count();
        $count_product_selling = Product::where('selling_products', 2)->count();

        $count = [$count_product_active, $count_product_trash, $count_product_all, $count_product_stocking, $count_product_out_stock, $count_product_highlights, $count_product_normal, $count_product_selling ];

        return view('admin.product.list', compact('products', 'count', 'list_act'));
    }

    function add()
    {
        $product_types = Product_type::all();
        $product_cat = Product_cat::all();
        return view('admin.product.add', compact('product_cat', 'product_types'));
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'price' => 'required',
                'product_detail' => 'required',
                'cat_id' => 'required',
                'file' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá',
                'product_detail' => 'Chi tiết sản phẩm',
                'cat_id' => 'Loại sản phẩm',
                'file' => 'Ảnh sản phẩm',
            ],
        );
        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $filename = $file->getClientOriginalName();

            //đuôi file
            $file->getClientOriginalExtension();
            //Lấy kích thuoc file
            $file->getSize();

            $path = $file->move('public/uploads/product/', $file->getClientOriginalName());
            $thumbnail = 'uploads/product/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        // dd($request->all());

        $id = Auth::id();
        $status = $request->status;
        $product_cat = $request->product_cat;
        // return $product_cat;
        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'price_old' => $request->input('price_old'),
            'product_desc' => $request->input('product_desc'),
            'product_detail' => $request->input('product_detail'),
            'product_cat' => $product_cat,
            'thumbnail' => $input['thumbnail'],
            'user_id' => $id,
            'cat_id' => $request->input('cat_id'),
            'status' => $status,
            'selling_products' => $request->input('selling')
        ]);
        return redirect('admin/product/list')->with('status', "Đã thêm sản phẩm thành công");
    }

    function delete($id)
    {
        Product::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect('admin/product/list')->with('status', 'Đã xóa sản phẩm thành công');
    }

    function edit($id)
    {
        $product_cat = Product_cat::all();
        $product_types = Product_type::all();
        $product = Product::find($id);
        return view('admin/product/edit', compact('product', 'product_cat', 'product_types'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'file' => 'required|image',
                'price' => 'required',
                'product_detail' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá',
                'product_detail' => 'Chi tiết sản phẩm',
                'file' => 'Hình ảnh sản phẩm'
            ],
        );
        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $filename = $file->getClientOriginalName();

            //đuôi file
            $file->getClientOriginalExtension();
            //Lấy kích thuoc file
            $file->getSize();

            $path = $file->move('public/uploads/product/', $file->getClientOriginalName());
            $thumbnail = 'uploads/product/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        // $input['thumbnail'] = $thumbnail;
        // $id = Auth::id();
        // $status = $request->status;
        $product_cat = $request->product_cat;
        Product::where('id', $id)->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'price_old' => $request->input('price_old'),
            'product_desc' => $request->input('product_desc'),
            'product_detail' => $request->input('product_detail'),
            'product_cat' => $product_cat,
            'cat_id' => $request->input('cat_id'),
            'thumbnail' => $thumbnail,
            // 'user_id' => $id,
            // 'status' => $status,
        ]);
        // return $thumbnail;
        return redirect('admin/product/list')->with('status', "Đã cập nhật sản phẩm thành công");
    }




    # PHẦN DANH MỤC SẢN  PHẨM
    function list_cat()
    {
        $product_cats = Product_cat::paginate(10);
        return view('admin.product.list_cat', ['product_cats' => $product_cats]);
    }

    function add_cat()
    {
        $product_cats = Product_cat::all();
        $product_types = Product_type::all();
        // return $product_cats;
        return view('admin.product.add_cat', ['product_cats' => $product_cats], ['product_types' => $product_types]);
    }

    function store_cat(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh muc',
                'slug' => 'Slug'
            ],
        );

        // return $request->parent_id;
        Product_cat::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'cat_id' => $request->input('cat_id'),
            'parent_id' => $request->parent_id,
        ]);
        return redirect('admin/product/list_cat')->with('status', "Đã thêm danh mục thành công");
    }

    function delete_cat($id)
    {
        Product_cat::destroy($id);
        return redirect('admin/product/list_cat')->with('status', 'Đã xóa danh mục thành công');
    }

    function edit_cat($id)
    {
        $product_cats = Product_cat::all();
        $product_cat = Product_cat::find($id);
        $product_types = Product_type::all();
        // return $product_cat;
        return view('admin.product.edit_cat', compact('product_cats', 'product_cat', 'product_types'));
    }

    function update_cat(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh muc',
                'slug' => 'Slug'
            ],
        );

        // return $request->parent_id;
        Product_cat::where('id', $id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'cat_id' => $request->input('cat_id'),
            'parent_id' => $request->parent_id,
        ]);
        return redirect('admin/product/list_cat')->with('status', "Đã cập nhật danh mục thành công");
    }

    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                // return $act;
                if ($act == 'delete') {
                    Product::destroy($list_check);
                    return redirect('admin/product/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    Product::withTrashed()
                        ->where('id', $list_check)
                        ->restore();
                    return redirect('admin/product/list')->with('status', 'Khôi phục sản phẩm thành công');
                }

                if ($act == 'forceDelete') {
                    Product::withTrashed()
                        ->where('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/product/list')->with('status', 'Đã xóa vĩnh viển sản phẩm');
                }

                if ($act == 'out_stock') {
                    $out_stock = Product::find($list_check);
                    $out_stock->status = '0';
                    $out_stock->save();
                    return redirect('admin/product/list')->with('status', 'Đã chuyển sản phẩm về trang thái hết hàng');
                }

                if ($act == 'stocking') {
                    $stocking = Product::find($list_check);
                    $stocking->status = '1';
                    $stocking->save();
                    return redirect('admin/product/list')->with('status', 'Đã chuyển sản phẩm về trang thái còn hàng');
                }

                if ($act == 'highlights') {
                    $stocking = Product::find($list_check);
                    $stocking->status = '2';
                    $stocking->save();
                    return redirect('admin/product/list')->with('status', 'Đã chuyển sản phẩm về trang thái Nổi bật');
                }

                if ($act == 'normal') {
                    $normal = Product::find($list_check);
                    $normal->selling_products = '0';
                    $normal->save();
                    return redirect('admin/product/list')->with('status', 'Đã chuyển sản phẩm thành bình thường');
                }

                if ($act == 'selling') {
                    $selling = Product::find($list_check);
                    $selling->selling_products = '1';
                    $selling->save();
                    return redirect('admin/product/list')->with('status', 'Đã chuyển sản phẩm thành bán chạy');
                }

                if ($act == '') {
                    return redirect('admin/product/list')->with('status_danger', 'Bạn cần chọn tác vụ áp dụng để thực thi');
                }
            }
            return redirect('admin/product/list')->with('status_danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/product/list')->with('status_danger', 'Bạn cần chọn phần tử cần thực thi');
        }
    }

    function detail($id)
    {
        $detail = Product::find($id);
        return view('admin.product.product_detail', compact('detail'));
    }


    # PHẦN PRODUCT_IMAGE

    function add_image()
    {
        $product_images = Product::all();
        return view('admin.product.add_image', compact('product_images'));
    }


    function store_image(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'file' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên sản phẩm',
                'file' => 'Hình ảnh slider sane phẩm',
            ],
        );
        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $filename = $file->getClientOriginalName();

            //đuôi file
            $file->getClientOriginalExtension();
            //Lấy kích thuoc file
            $file->getSize();

            $path = $file->move('public/uploads/product/images/', $file->getClientOriginalName());
            $thumbnail = 'uploads/product/images/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        // dd($request->all());

        // $id = Auth::id();
        // $status = $request->status;
        // $product_cat = $request->product_cat;
        // return $product_cat;
        Product_image::create([
            'name' => $request->input('name'),
            'image' => $thumbnail,
            'product_id' => $request->input('product_id'),
        ]);
        // return "OK";
        return redirect('admin/product/list_image')->with('status', "Đã thêm hình ảnh slider của sản phẩm thành công");
    }

    function list_image(Request $request)
    {
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $product_images  = Product_image::where('name', 'LIKE', "%{$keyword}%")->paginate(10);

        return view('admin.product.list_image', compact('product_images'));
    }

    function delete_image($id)
    {
        $product_images = Product_image::withTrashed()
            ->where('id', $id)
            ->forceDelete();

        return redirect('admin/product/list_image')->with('status', 'Đã xóa ảnh slider của sản phẩm thành công');
    }

    public function edit_image($id)
    {
        $product_images = Product::all();
        $product_image = Product_image::find($id);

        return view('admin.product.edit_image', compact('product_image', 'product_images'));
    }

    public function update_image(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'file' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên sản phẩm',
                'file' => 'Hình ảnh slider sane phẩm',
            ],
        );

        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $filename = $file->getClientOriginalName();

            //đuôi file
            $file->getClientOriginalExtension();
            //Lấy kích thuoc file
            $file->getSize();

            $path = $file->move('public/uploads/product/images/', $file->getClientOriginalName());
            $thumbnail = 'uploads/product/images/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        Product_image::where('id', $id)->update([
            'name' => $request->input('name'),
            'product_id' =>$request->input('product_id'),
            'image' => $input['thumbnail'],
        ]);

        return redirect('admin/product/list_image')->with('status', 'Cập nhật thành công');
    }
}
