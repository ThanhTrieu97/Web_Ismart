<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('public/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/main.css') }}" rel="stylesheet" type="text/css" />



    <script src="{{ url('public/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/main.js') }}" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{ url('/') }}" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?page=blog" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Giới thiệu</a>
                                </li>
                                @foreach ($pages as $page)
                                    <li>
                                        <a href="{{ asset($page->slug) }}" title="">{{ $page->name }}</a>
                                    </li>
                                @endforeach

                                <li>
                                    <a href="?page=detail_blog" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{ url('/') }}" title="" id="logo" class="fl-left"><img
                                src="{{ url('public/images/logo.png') }} " /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="{{ route('searchname') }}">
                            <div class="form-group">
                                <input type="text" name="keyword" id="country_name" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                                <div id="countryList"><br>
                                    <div class="sremain">
                                        <ul style="display:none">

                                        </ul>
                                    </div>
                                </div>
                            </div>



                            </form>
                            {{ csrf_field() }}
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0962.563.254</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">2</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span>2 sản phẩm</span> trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="public/images/img-pro-11.png" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title="" class="product-name">Sony Express X6</a>
                                                <p class="price">6.250.000đ</p>
                                                <p class="qty">Số lượng: <span>1</span></p>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="public/images/img-pro-23.png" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title="" class="product-name">Laptop Lenovo 10</a>
                                                <p class="price">16.250.000đ</p>
                                                <p class="qty">Số lượng: <span>1</span></p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">18.500.000đ</p>
                                    </div>
                                    <div class="action-cart clearfix">
                                        <a href="#" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh
                                            toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">ISMART</h3>
                            <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính
                                sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="public/images/img-foot.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                                </li>
                                <li>
                                    <p>0987.654.321 - 0989.989.989</p>
                                </li>
                                <li>
                                    <p>vshop@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách hội viện</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                            <div id="form-reg">
                                <form method="POST" action="">
                                    <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                                    <button type="submit" id="sm-reg">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="?page=home" title>Trang chủ</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Điện thoại</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Samsung</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title="">Iphone X</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Iphone 8</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Nokia</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Máy tính bảng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
                    </li>
                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="#" title>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        </script>

        <script>
            $(document).ready(function() {

                $('#country_name').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
                    var query = $(this).val(); //lấy gía trị ng dùng gõ
                    if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
                    {
                        var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                        $.ajax({
                            url: "{{ route('search') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                            method: "POST", // phương thức gửi dữ liệu.
                            data: {
                                '_token': '{{ csrf_token() }}',
                                query: query,
                                _token: _token
                            },
                            success: function(data) { //dữ liệu nhận về
                                $('#countryList').fadeIn();
                                $('#countryList').html(
                                    data
                                ); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
                            }
                        });
                    }
                });

                $(document).on('click', 'li', function() {
                    $('#country_name').val($(this).text());
                    $('#countryList').fadeOut();
                });

            });

        </script>


</body>

</html>
