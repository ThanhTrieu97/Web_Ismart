@extends('layouts/admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm mới danh mục
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/product/store_cat') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input class="form-control" type="text" name="slug" id="slug">
                            </div>
                            <div class="form-group">
                                <label for="cat_id">Danh muc thuộc loại sản phẩm</label>
                                <select class="form-control" id="cat_id" name="cat_id">
                                    <option value="0">Chọn danh mục</option>
                                    @foreach ($product_types as $product_type)
                                        <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Danh mục cha</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="0">Chọn danh mục</option>
                                    @php
                                        showProductCat($product_cats);
                                    @endphp
                                    {{-- @foreach ($product_cat as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            {{-- <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                        </div> --}}



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
