@extends('layouts/admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{ url('admin/post/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="title" id="title">
                    @error('title')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
                </div>
                <div class="form-group">
                    <label for="post_desc">Mô tả ngắn</label>
                    <textarea name="post_desc" class="form-control" id="post_desc" cols="30" rows="20"></textarea>
                    @error('post_desc')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="20"></textarea>
                    @error('content')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
                </div>


                <div class="form-group">
                    <label for="post_id">Danh mục</label>
                    <select class="form-control" id="post_id" name="post_id">
                      <option value="0">Chọn danh mục</option>
                     @php
                         showPostCat($post_cat);
                     @endphp
                    </select>
                </div>
                <div class="form-group">
                    <label for="page_id">Trang</label>
                    <select class="form-control" id="page_id" name="page_id">
                      <option value="0">Chọn danh mục</option>
                      @foreach ($pages as $page)
                          <option value="{{ $page->id }}">{{ $page->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Hình ảnh bài viết</label>
                    <input class="form-control-file" onchange="showThumbNail(this)" name="file" type="file" id="file">
                    <img id="thumbnail" src="" alt="">
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" id="status1" checked="checked" name="status" type="radio" value="0">
                        <label for="status1" class="form-check-label">Chờ duyệt</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="status2" name="status" type="radio" value="1">
                        <label for="status2" class="form-check-label">Công khai</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
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
            showPostCat($post_cats, $item->id, $char . '-- ');
        }
    }
}
@endphp
@endsection
