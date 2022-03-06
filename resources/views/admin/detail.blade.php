@extends('layouts/admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="">
                    <div class="detail">CHI TIẾT ĐƠN HÀNG</div>
                    <div class="card-body">
                        <img class="img" src="{{ asset($detail->image) }}" alt="">
                        <p class="detail_code"><strong>Mã đặt hàng:</strong><span class="range1">{{ $detail->code }}</span></p>
                        <p class="detail_code"><strong>Khách hàng:</strong><span class="range2">{{ $detail->customer }}</span></p>
                        <p class="detail_code"><strong>Số điện thoại:</strong><span class="range3">{{ $detail->phone_number }}</span></p>
                        <p class="detail_code"><strong>Địa chỉ:</strong><span class="range4">{{ $detail->address }}</span></p>
                        <p class="detail_code"><strong>Sản phẩm:</strong><span class="range5">{{ $detail->order_cat_id->name }}</span></p>
                        <p class="detail_code"><strong>Sô lượng:</strong><span class="range6">{{ $detail->number_order }}</span></p>
                        <p class="detail_code"><strong>Tổng tiền:</strong><span class="range7">{{ $detail->total }}đ</span></p>
                        <p class="detail_code"><strong>Thời gian:</strong><span class="range8">{{ $detail->created_at }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
