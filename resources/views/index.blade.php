@extends('layouts/home')

@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        @foreach ($sliders as $slider)
                            <div class="item">
                                <img src="{{ asset($slider->thumbnail) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="section" id="support-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-1.png">
                                </div>
                                <h3 class="title">Miễn phí vận chuyển</h3>
                                <p class="desc">Tới tận tay khách hàng</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-2.png">
                                </div>
                                <h3 class="title">Tư vấn 24/7</h3>
                                <p class="desc">1900.9999</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-3.png">
                                </div>
                                <h3 class="title">Tiết kiệm hơn</h3>
                                <p class="desc">Với nhiều ưu đãi cực lớn</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-4.png">
                                </div>
                                <h3 class="title">Thanh toán nhanh</h3>
                                <p class="desc">Hỗ trợ nhiều hình thức</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-5.png">
                                </div>
                                <h3 class="title">Đặt hàng online</h3>
                                <p class="desc">Thao tác đơn giản</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($highlights as $highlight)
                                <li>
                                    <a href="{{ route('detail.product.show', $highlight->id) }}" title="" class="thumb">
                                        <img src="{{ asset($highlight->thumbnail) }}">
                                    </a>
                                    <a href="{{ route('detail.product.show', $highlight->id) }}" title=""
                                        class="product-name">{{ $highlight->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($highlight->price, 0, '', '.') }}đ</span>
                                        <span class="old">{{ number_format($highlight->price_old, 0, '', '.') }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', $highlight->id) }}" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="{{ route('detail.product.show', $highlight->id) }}" title="" class="buy-now fl-right">Xem chi tiết</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                </div>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Điện thoại</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($phones as $phone)
                                <li>
                                    <a href="{{ route('detail.product.show', $phone->id) }}" title="" class="thumb">
                                        <img src="{{ asset($phone->thumbnail) }}">
                                    </a>
                                    <a href="{{ route('detail.product.show', $phone->id) }}" title=""
                                        class="product-name">{{ $phone->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($phone->price, 0, '', '.') }}đ</span>
                                        <span class="old">{{ number_format($phone->price_old, 0, '', '.') }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', $phone->id) }}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ
                                            hàng</a>
                                        <a href="{{ route('detail.product.show', $phone->id) }}" title="Mua ngay" class="buy-now fl-right">Xem chi tiết</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="section" id="paging">
                        <div class="section-detail">
                            <ul class="list-item clearfix" style="display: flex;  margin-left: 395px; margin-top: 5px; height: 0px;">
                                {{ $phones->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Laptop</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($laptops as $laptop)
                                 <li>
                                <a href="{{ route('detail.product.show', $laptop->id) }}" title="" class="thumb">
                                    <img src="{{ asset($laptop->thumbnail) }}">
                                </a>
                                <a href="{{ route('detail.product.show', $laptop->id) }}" title="" class="product-name">{{ $laptop->name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($laptop->price, 0, '', '.') }}đ</span>
                                    <span class="old">{{ number_format($laptop->price_old, 0, '', '.') }}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="{{ route('cart.add', $laptop->id) }}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{ route('detail.product.show', $laptop->id) }}" title="Mua ngay" class="buy-now fl-right">Xem chi tiết</a>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="section" id="paging">
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                {{-- {{ $laptops->withQueryString()->links() }} --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Danh mục sản phẩm</h3>
                    </div>
                    <div class="secion-detail">
                        <ul class="list-item">
                            @if (!empty($product_cats))
                                @foreach ($product_cats as $product_cat)
                                    <li>
                                        @if ($product_cat->parent_id == 0)
                                            <a href="{{ route('all_product', $product_cat->cat_id) }}"
                                                title="">{{ $product_cat->name }}</a>
                                            <ul class="sub-menu">
                                                @foreach ($product_cats as $childs)
                                                    <li>
                                                        @if ($product_cat->id == $childs->parent_id)
                                                            <a href="{{ route('list_product', $childs->id) }}"
                                                                title="">{{ $childs->name }}</a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($sellings as $selling)
                                <li class="clearfix">
                                    <a href="{{ route('detail.product.show', $selling->id) }}" title="" class="thumb fl-left">
                                        <img src="{{ asset($selling->thumbnail) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('detail.product.show', $selling->id) }}" title="" class="product-name">{{ $selling->name }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($selling->price, 0, '', '.') }}đ</span>
                                            <span class="old">{{ number_format($selling->price_old, 0, '', '.') }}đ</span>
                                        </div>
                                        <a href="{{ route('detail.product.show', $selling->id) }}" title="" class="buy-now">Xem chi tiết</a>
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
