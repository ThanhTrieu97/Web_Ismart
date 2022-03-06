@extends('layouts/home')

@section('content')
    <div id="main-content-wp" class="clearfix category-product-page">
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
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">{{ $cat_name->name }} <span style="font-size: 20px;font-family: none;">({{ $count }} sản phẩm)</span></h3>
                        <div class="filter-wp fl-right">
                            <div class="form-filter">
                                <form method="POST" action="" style="visibility: hidden">
                                    <select name="select">
                                        <option value="0">Sắp xếp</option>
                                        <option value="1">Từ A-Z</option>
                                        <option value="2">Từ Z-A</option>
                                        <option value="3">Giá cao xuống thấp</option>
                                        <option value="3">Giá thấp lên cao</option>
                                    </select>
                                    <button type="submit">Lọc</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($all_product as $value)
                                <li>
                                    <a href="{{ route('detail.product.show', $value->id) }}" title="" class="thumb">
                                        <img src="{{ asset($value->thumbnail) }}">
                                    </a>
                                    <a href="{{ route('detail.product.show', $value->id) }}" title="" class="product-name">{{ $value->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($value->price, 0, '', '.') }}đ</span>
                                        <span class="old">{{ number_format($value->price_old, 0, '', '.') }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', $value->id) }}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ
                                            hàng</a>
                                        <a href="{{ route('detail.product.show', $value->id) }}" title="Mua ngay" class="buy-now fl-right">Xem chi tiết</a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            {{  $all_product->links() }}
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
