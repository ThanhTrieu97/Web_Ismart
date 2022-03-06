@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-5 font-size">
        @if (session('status_danger'))
            <div class="alert alert-danger">
                {{ session('status_danger') }}
            </div>
        @endif
        <div class="row">
            @foreach ($orders as $order)

            @endforeach
            <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $count[1] }}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $count[0] }}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{!! $total!!}đ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $count[2] }}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá trị</th>
                            <th scope="col">Trạng thái</th>
                            {{-- <th scope="col">Thời gian</th> --}}
                            <th scope="col">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($orders as $order)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <td>{{ $t }}</td>
                                <td>{{ $order->code }}</td>
                                <td>
                                    {{ $order->customer }} <br>
                                    {{ $order->phone_number }}
                                </td>
                                <td>{{ $order->way }}, <br> {{ $order->ward }}, <br> {{ $order->district }} <br> {{ $order->province }} </td>
                                <td>{{ $order->order_cat_id->name }}</></td>
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
                                <td><a href="{{ route('detail', $order->id) }}" class="btn btn-success">Xem</a></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
        {{-- <script>
            $(document).ready(function() {
                LoadData();
            });

            function LoadData() {
                $.ajax({
                    type: "GET",
                    url: "http://localhost:8080/unitop.vn/laravelpro/unimart/dashboard",
                    success: function(rs) {
                        console.log(rs);
                        var str = "";
                        $.each(rs, function(i, item) {
                            str += "<tr>";
                            str += "<td><a class='btn btn-success'>Xem </a></td>"
                            str += "</tr>";
                        });
                    }
                });
                $('#load_data').html(str);
            }

        </script> --}}
    </div>
@endsection
