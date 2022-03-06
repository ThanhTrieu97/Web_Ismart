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
                <h5 class="m-0 ">Danh sách đơn hàng</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}" class="text-primary">Kích
                        hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'handled']) }}" class="text-primary">Đang xử
                        lý<span class="text-muted">({{ $count[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'finish']) }}" class="text-primary">Hoàn
                        thành<span class="text-muted">({{ $count[3] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'shipping']) }}" class="text-primary">Đang giao
                        hàng<span class="text-muted">({{ $count[4] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Thùng
                        rác<span class="text-muted">({{ $count[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'cancelled']) }}" class="text-primary">Đã
                        hủy<span class="text-muted">({{ $count[5] }})</span></a>
                </div>
                <form action="{{ url('admin/order/action') }}" method="">
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
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Mã</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá trị</th>
                                <th scope="col">Trạng thái</th>
                                {{-- <th scope="col">Thời gian</th> --}}
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->total() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($orders as $order)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check" value="{{ $order->id }}">
                                        </td>
                                        <td>{{ $t }}</td>
                                        <td>{{ $order->code }}</td>
                                        <td>
                                            {{ $order->customer }} <br>
                                            {{ $order->phone_number }}
                                        </td>
                                        <td>{{ $order->way }}, <br> {{ $order->ward }}, <br> {{ $order->district }} <br> {{ $order->province }} </td>
                                        <td><a href="#">{{ $order->order_cat_id->name }}</a></td>
                                        <td>{{ $order->number_order }}</td>
                                        <td>{{ $order->total }}đ</td>
                                        @if ($order->status == 0)
                                            <td><span class="badge badge-warning">Đang xử lý</span></td>
                                        @endif
                                        @if ($order->status == 1)
                                            <td><span class="badge badge-success">Hoàn thành</span></td>
                                        @endif
                                        @if ($order->status == 2)
                                            <td><span class="badge badge-primary">Đang giao hàng</span></td>
                                        @endif
                                        @if ($order->status == 3)
                                            <td><span class="badge badge-danger">Đã hủy</span></td>
                                        @endif
                                        {{-- <td>{{ $order->created_at }}</td> --}}
                                        <td>
                                            {{-- <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a> --}}
                                            <a href="{{ route('delete_order', $order->id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn đơn hàng này')"
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
                {{ $orders->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
