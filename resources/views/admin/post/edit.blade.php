@extends('layouts/admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật bài viêt
            </div>
            <div class="card-body">
                <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{ $post->title }}">
                        @error('title')
                            <small class="text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="post_desc">Mô tả ngắn</label>
                        <textarea name="post_desc" class="form-control" id="post_desc" cols="30" rows="20">{{ $post->post_desc }}</textarea>
                        @error('post_desc')
                        <small class="text text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="content" class="form-control" id="content" cols="30" rows="20">{{ $post->content }}</textarea>
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
                        <label for="file">Hình ảnh sản phẩm <label for="file" style="color: red">(Bắt buộc chọn lại ảnh bài viết)</label></label>
                        <input class="form-control-file" onchange="showThumbNail(this)" name="file" type="file" id="file">
                        <img id="thumbnail" src="" alt="">
                        @error('file')
                        <small class="text text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
