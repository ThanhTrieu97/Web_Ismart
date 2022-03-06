@extends('layouts/home')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Kết quả tìm kiếm</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($products as $product)
                            <li>
                                <a href="{{ route('detail.product.show', $product->id) }}" title="" class="thumb">
                                    <img src="{{ asset($product->thumbnail) }}">
                                </a>
                                <a href="{{ route('detail.product.show', $product->id) }}" title=""
                                    class="product-name">{{ $product->name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($product->price, 0, '', '.') }}đ</span>
                                    <span class="old">{{ number_format($product->price_old, 0, '', '.') }}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="{{ route('cart.add', $product->id) }}" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{ route('detail.product.show', $product->id) }}" title="" class="buy-now fl-right">Xem chi tiết</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

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
                                        <a href="{{ route('all_product', $product_cat->cat_id) }}" title="">{{ $product_cat->name }}</a>
                                        <ul class="sub-menu">
                                            @foreach ($product_cats as $childs)
                                                <li>
                                                    @if ($product_cat->id == $childs->parent_id)
                                                        <a href="{{ route('list_product', $childs->id) }}" title="">{{ $childs->name }}</a>
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
