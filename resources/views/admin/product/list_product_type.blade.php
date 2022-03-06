@extends('layouts/admin')

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
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách ảnh slider của sản phẩm</h5>
                <div class="form-search form-inline">
                </div>
            </div>
            <div class="card-body">
                <form action="" method="">
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Tên loại sản phẩm</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($product_types->total() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($product_types as $product_type)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr class="">
                                        <td>
                                            <input type="checkbox" name="list_check" value="">
                                        </td>
                                        <td>{{ $t }}</td>
                                        <td>{{ $product_type->name }}</td>
                                        <td>{{ $product_type->created_at }}</td>
                                        <td>
                                            {{-- <a href="{{ route('product_image.edit', $product_image->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a> --}}
                                            <a href="{{ route('delete_product_type', $product_type->id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn loại sản phẩm này?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white" style="color: red">Không tìm thấy bản ghi</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $product_types->links() }}
            </div>
        </div>
    </div>
@endsection
