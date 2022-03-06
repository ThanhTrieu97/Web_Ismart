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
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
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
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'stocking']) }}" class="text-primary">Còn
                        hàng<span class="text-muted">({{ $count[3] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'out_stock']) }}" class="text-primary">Hết
                        hàng<span class="text-muted">({{ $count[4] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'highlights']) }}" class="text-primary">Nổi
                        bật<span class="text-muted">({{ $count[5] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Thùng
                        rác<span class="text-muted">({{ $count[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" class="text-primary">Tất cả<span
                            class="text-muted">({{ $count[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'normal']) }}" class="text-primary">Bình thường<span
                            class="text-muted">({{ $count[6] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'selling']) }}" class="text-primary">Bán chạy<span
                            class="text-muted">({{ $count[7] }})</span></a>
                </div>
                <form action="{{ url('admin/product/action') }}" method="">
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
                                <th scope="col" style="opacity: 0;">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Bán chạy</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->total() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($products as $product)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr class="">
                                        <td>
                                            <input type="checkbox" name="list_check" value="{{ $product->id }}">
                                        </td>
                                        <td>{{ $t }}</td>
                                        <td><img style="width: 70px;" src="{{ asset($product->thumbnail) }}" alt=""></td>
                                        <td style="max-width: 350px;"><a
                                                href="{{ route('detail_product', $product->id) }}">{{ $product->name }}</a>
                                        </td>
                                        <td>{{ number_format($product->price, 0, '', '.') }}đ</td>
                                        <td>{{ $product->product_cat_id->name }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        @if ($product->status == 1)
                                            <td><span class="badge badge-success">Còn hàng</span></td>
                                        @endif
                                        @if ($product->status == 0)
                                            <td><span class="badge badge-danger">Hết hàng</span></td>
                                        @endif
                                        @if ($product->status == 2)
                                            <td><span class="badge badge-primary">Nổi bật</span></td>
                                        @endif
                                        @if ($product->selling_products == 0)
                                            <td><span class=""></span></td>
                                        @endif
                                        @if ($product->selling_products == 1)
                                            <td><img style="width: 50px" src="{{ asset('images/Tich-xanh.png') }}" alt=""></td>
                                        @endif

                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('delete_product', $product->id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này?')"
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
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
