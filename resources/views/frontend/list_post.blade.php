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
                        <h3 class="section-title">{{ $page_name }}</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($posts as $post)
                                <li class="clearfix">
                                    <a href="{{ route('detail.post', $post->id) }}" title="" class="thumb fl-left">
                                        <img src="{{ asset($post->thumbnail) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('detail.post', $post->id) }}" title=""
                                            class="title">{{ $post->title }}</a>
                                        <span class="create-date">{{ $post->created_at }}</span>
                                        <p class="desc">{!! $post->post_desc !!}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            {{ $posts->links() }}
                        </ul>
                    </div>
                </div>
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
