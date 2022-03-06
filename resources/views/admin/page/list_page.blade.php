@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid font-size">
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
        <div class="modal fade" id="Modal-page-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style=" background: #186bc3;color: #fff;">
                        <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết trang</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body container">
                        <p class="text-center"><img src="" alt="" style="width:90px;max-height:90px;list-style: none;"></p>
                        <div class="row ">
                            <div class="col-md-12">
                                    <ul class="p-2 mb-0 shadow-lg">
                                        <li class="mt-0">
                                            <div class="row no-gutters">
                                                <div class="col-md-4 pr-2">
                                                    <label for="" style="">Người tạo</label>
                                                </div>
                                                <div class="col-md-8 user">
                                                    <p style="">$detail->user_id</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách trang</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                {{-- <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th> --}}
                                <th scope="col">#</th>
                                {{-- <th scope="col">Ảnh</th> --}}
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Ngày tạo</th>
                                {{-- <th scope="col">Chi tiết</th> --}}
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @if ($pages->total() > 0) --}}
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($pages as $page)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr class="page">
                                        {{-- <td>
                                            <input type="checkbox">
                                        </td> --}}
                                        <td>{{ $t }}</td>
                                        {{-- <td><img src="http://via.placeholder.com/80X80" alt=""></td> --}}
                                        <td><span class="pd-name">{{ $page->name }}</span></td>
                                        <td>{{ $page->slug }}</td>
                                        <td>{{ $page->created_at }}</td>
                                        {{-- <td id="page-detail" data-id="{{ $page->id }}" data-toggle="modal"
                                            data-target="#Modal-page-detail" style="cursor: pointer">
                                            <img width="30px" src="{{ asset('uploads/click.jpg') }}" alt="">
                                        </td> --}}
                                        {{-- <td><span class="badge badge-success">Còn hàng</span></td> --}}
                                        <td>
                                            <a href="{{ route('page.edit', $page->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                                    <a href="{{ route('delete_page', $page->id) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viển trang này?')"
                                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            {{-- @else
                                <tr>
                                    <td colspan="7" class="bg-white" style="color: red">Không tìm thấy bản ghi</td>
                                </tr>
                            @endif --}}
                        </tbody>
                    </table>
                    {{-- {{ $pages->links() }} --}}
                </form>
            </div>
        </div>
    </div>

@endsection
