@extends('layouts/admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/post/store_cat') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Danh mục cha</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="0">Chọn danh mục</option>
                                @php
                                    showPostCat($post_cats);
                                @endphp

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    function showPostCat($post_cats, $parent_id = 0, $char = '')
    {
        foreach ($post_cats as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id) {
                echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
                // Xóa chuyên mục đã lặp
                unset($post_cats[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showPostCat($post_cats, $item->id, $char . '--');
            }
        }
    }

@endphp

@endsection
