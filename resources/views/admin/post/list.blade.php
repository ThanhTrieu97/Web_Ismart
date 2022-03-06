@extends('layouts/admin')

@section('content')
<div id="content" class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('status_danger'))
    <div class="alert alert-danger">
        {{ session('status_danger') }}
    </div>
@endif
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" name="keyword"
                    value="{{ request()->input('keyword') }}" placeholder="Tìm kiếm">
                <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
            </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}" class="text-primary">Kích
                    hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Thùng rác<span class="text-muted">({{ $count[1] }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'public']) }}" class="text-primary">Công khai<span class="text-muted">({{ $count[2] }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}" class="text-primary">Chờ duyệt<span class="text-muted">({{ $count[3] }})</span></a>

            </div>
            <form action="{{ url('admin/post/action') }}" method="">
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="act">
                    <option value="">Chọn</option>
                    @foreach ($list_act as $k => $act)
                                <option value="{{ $k }}">{{ $act }}</option>
                            @endforeach
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                        <td>
                            <input type="checkbox" name="list_check" value="{{ $post->id }}">
                        </td>
                        <td scope="row">1</td>
                        <td><img style="width: 60px" src="{{ asset($post->thumbnail) }}" alt=""></td>
                        <td style="max-width: 350px;">{{ $post->title }}</td>
                        <td>{{ $post->post_cat_id->name }}</td>
                        <td>{{ $post->created_at }}</td>
                        @if ($post->status == 1)
                        <td><span class="badge badge-success">Công khai</span></td>
                    @else
                        <td><span class="badge badge-danger">Chờ duyệt</span></td>
                    @endif
                    <td>
                        <a href="{{ route('post.edit', $post->id) }}"
                            class="btn btn-success btn-sm rounded-0 text-white" type="button"
                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ route('delete_post', $post->id) }}"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bài viết này?')"
                            class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                class="fa fa-trash"></i></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        {{ $posts->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
