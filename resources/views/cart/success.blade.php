@extends('layouts/home')

@section('content')
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        {{-- <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
                <div class="section" id="customer-info-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center" id="wp-message">
                                    <h3 class="text-success" style="position: relative; right: 80px; font-size: 28px">Bạn đã đặt hàng thành công</h3>
                                    <h2 class="text-success"><i style="position: relative; left: 72px; margin-top: 20px; font-size: 28px;" class="far fa-check-circle"></i></h2>
                                    <p style="position: relative; right: 75px; margin-top: 10px; font-size: 16px;">Nhân viên chúng tôi sẽ liên hệ với bạn sớm nhất!</p>
                                    <p style="position: relative; left: 17px; margin-top: 10px; font-size: 16px; margin-bottom: 50px;">Trân trọng cảm ơn!</p>
                                    <a style="border: 1px solid #0d0d0d; background: #7b778f; color: white; padding: 10px; position: relative;left: 19px;" class="btn-secondary btn mt-5" href="{{ url('/') }}">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
