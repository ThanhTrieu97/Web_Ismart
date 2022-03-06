@extends('layouts/home')

@section('content')
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    {{-- <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Điện thoại</a>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" class="thumb" src="{{ asset($products->thumbnail) }}"
                                    data-zoom-image="{{ asset($products->thumbnail) }}" />
                            </a>
                            <div id="list-thumb">
                                <a href="" data-image="{{ asset($products->thumbnail) }}"
                                    data-zoom-image="{{ asset($products->thumbnail) }}">
                                    <img id="zoom" src="{{ asset($products->thumbnail) }}" />
                                </a>
                                @foreach ($product_images as $product_image)
                                    <a href="" data-image="{{ asset($product_image->image) }}"
                                        data-zoom-image="{{ asset($product_image->image) }}">
                                        <img id="zoom" src="{{ asset($product_image->image) }}" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="public/images/img-pro-01.png" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $products->name }}</h3>
                            <div class="desc">
                                {!! $products->product_desc !!}

                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status">
                                    @if ($products->status == 1)
                                        <td><span class="badge badge-success">Còn hàng</span></td>
                                    @endif
                                    @if ($products->status == 2)
                                        <td><span class="badge badge-success">Còn hàng</span></td>
                                    @endif
                                    @if ($products->status == 0)
                                        <td><span class="badge badge-danger">Tạm hết hàng</span></td>
                                    @endif
                                </span>
                            </div>
                            <p class="price">{{ number_format($products->price, 0, '', '.') }}đ</p>
                            <div id="num-order-wp">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" min="1" max="10" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <a href="{{ route('cart.add', $products->id) }}" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                        </div>
                    </div>
                </div>


                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        {!! $products->product_detail !!}
                    </div>
                    <p class="dtcvmodetail" style="display: block; cursor: pointer; color: #288ad6;"><span>Đọc thêm <i style="color: #288ad6;">▾</i></span></p>
                    <p class="dtchide" style="display: none; cursor: pointer; color: #288ad6;"><span>Rút gọn <i style="color: #288ad6;">▴</i></span></p>
                </div>





                {{-- <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <p class="accodition"> {!! $products->product_detail !!}</p>
                    </div>
                    <p class="dtcvmodetail" style="display: block;"><span>Đọc thêm <i>▾</i></span></p>
                    <p class="dtchide" style="display: none;"><span>Rút gọn <i>▴</i></span></p>
                </div> --}}

                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($same_category as $sam)
                                <li>
                                    <a href="{{ route('detail.product.show', $sam->id) }}" title="" class="thumb">
                                        <img src="{{ asset($sam->thumbnail) }}">
                                    </a>
                                    <a href="{{ route('detail.product.show', $sam->id) }}" title=""
                                        class="product-name">{{ $sam->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($sam->price, 0, '', '.') }}đ</span>
                                        <span class="old">{{ number_format($sam->price_old, 0, '', '.') }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="" title="" class="buy-now fl-right">Mua ngay</a>
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
    <script>


    </script>

@endsection
