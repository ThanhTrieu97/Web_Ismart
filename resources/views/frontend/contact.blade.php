@extends('layouts/home')

@section('content')
    <div id="main-content-wp" class="clearfix blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    {{-- <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul> --}}
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Liên hệ</h3>
                    </div>
                    <div class="section-detail">
                        <h3 style="text-align: center;font-size: 20px;">Cửa Hàng Di Động Bán Lẻ Kỹ Thuật Số ISMART</h3>
                        <p style="text-align: center; font-size: 15px; margin-top: 3px"><strong>Địa chỉ:</strong> 123 – 456 Huỳnh Tấn Phát, Q7, TP. Hồ Chí Minh</p>
                        <p style="text-align: center; font-size: 15px; margin-top: 3px"><strong>Điện thoại:</strong> 0962563254</p>
                        <p style="text-align: center; font-size: 15px;margin-top: 3px"><strong>Email: </strong> ismartmobile@gmail.com</p>
                    </div>
                </div>
                {{-- <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            {{ $posts->links() }}
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($sellings as $selling)
                                <li class="clearfix">
                                    <a href="{{ route('detail.product.show', $selling->id) }}" title=""
                                        class="thumb fl-left">
                                        <img src="{{ asset($selling->thumbnail) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('detail.product.show', $selling->id) }}" title=""
                                            class="product-name">{{ $selling->name }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($selling->price, 0, '', '.') }}đ</span>
                                            <span
                                                class="old">{{ number_format($selling->price_old, 0, '', '.') }}đ</span>
                                        </div>
                                        <a href="{{ route('detail.product.show', $selling->id) }}" title=""
                                            class="buy-now">Xem chi tiết</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        @foreach ($baners as $baner)
                            <a href="" title="" class="thumb">
                                <img src="{{ asset($baner->thumbnail) }}" alt="">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
