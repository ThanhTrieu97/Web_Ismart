@extends('layouts/admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm mới loại sản phẩm
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/product/store_product_type') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên loại sản phẩm</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>


                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    </div>

    @php
    function showProductCat($product_cats, $parent_id = 0, $char = '')
    {
        foreach ($product_cats as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id) {
                echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
                // Xóa chuyên mục đã lặp
                unset($product_cats[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showProductCat($product_cats, $item->id, $char . '--');
            }
        }
    }

    function data_tree($data, $parent_id = 0, $level = 0)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['parent_id'] == $parent_id) {
                $item['level'] = $level;
                $result[] = $item;
                unset($data[$item['id']]);
                $child = data_tree($data, $item['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    $product_cats = data_tree($product_cats);
    // echo "<pre>";
    // print_r($list_cat);
    // echo "</pre>";
    @endphp
@endsection
