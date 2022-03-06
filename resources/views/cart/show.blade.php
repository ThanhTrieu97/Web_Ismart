@extends('layouts/home')

@section('content')
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        {{-- <li>
                            <a href="{{ url('/') }}" title="">Trang chủ</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <form action="{{ route('cart.update.all') }}" method="POST">
                        @csrf
                        @if (Cart::count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Mã sản phẩm</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td colspan="2">Thành tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $t = 0;
                                    @endphp
                                    {{-- {{ Cart::content() }} --}}
                                    @foreach (Cart::content() as $row)
                                        @php
                                            $t++;
                                        @endphp
                                        <tr>
                                            <td>ISMART{{ $row->id }}</td>
                                            <td>
                                                <a href="" title="" class="thumb">
                                                    <img src="{{ asset($row->options->thumbnail) }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" title="" class="name-product">{{ $row->name }}</a>
                                            </td>
                                            <td>{{ number_format($row->price, 0, '', '.') }}đ</td>
                                            <td>
                                                <input type="text" value="{{ $row->qty }}" class="num-order"
                                                    id="input_quantity" min="1" max="10" name="qty[{{ $row->rowId }}]">
                                                <p data-price="{{ $row->price }}"
                                                    data-url="{{ route('cart.update', $row->rowId) }}"
                                                    data-id-product="{{ $row->id }}">
                                                    <span
                                                        style="border: 1px solid #8184bc2e;padding: 8px 14px; cursor: pointer;position: relative; top: -27px;left: -14px;"
                                                        class="js-renduction">-</span>
                                                    <span
                                                        style="border: 1px solid #8184bc2e;padding: 8px 13px; cursor: pointer;position: relative; top: -27px;left: 15px;"
                                                        class="js-increase">+</span>
                                                </p>
                                            </td>
                                            <td><span
                                                    class="js-total-item">{{ number_format($row->total, 0, '', '.') }}đ</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.remove', $row->rowId) }}" title=""
                                                    class="del-product"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <p id="total-price" class="fl-right">Tổng giá:
                                                    <span id="sub-total">{{ Cart::total() }}đ</span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <div class="fl-right">
                                                    <input type="submit" value="Cập nhật giỏ hàng" class="btn btn-primary"
                                                        name="'btn_update" id="update-cart">
                                                    <a href="{{ route('checkout') }}" title="" id="checkout-cart">Thanh toán</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Thanh toán”</span> để hoàn tất mua hàng.</p>
                    <a href="{{ url('/') }}" title="" id="buy-more">Mua tiếp</a><br />
                    <a href="{{ route('cart.destroy') }}" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        @else
            <div class="section-detail">
                <p class=""><img class="img-fluid d-inline-block" src="{{ url('public/images/cart-icon.png') }}" alt=""
                        style="width:75px;height:71px;display: inline-block!important;margin-left: 493px;width: 150px"></p>
                <p class=""
                    style="font-size: 16px;color: #4a4a4a;margin-bottom: 25px;display: inline-block!important; margin-left: 422px; color: red">
                    Không có sản phẩm nào trong giỏ hàng của bạn</p>
                <p class=""
                    style="margin-left: 477px; margin-right: 508px; border: 1px solid blue;padding: 10px;margin-bottom: 55px;">
                    <a href="{{ url('/') }}" class="re_unimart" title="Trang chủ">ĐẾN TRANG CHỦ ISMART</a>
                </p>
            </div>
            @endif
            </form>
        </div>
        <script>
            $('.js-increase').click(function(e) {
                e.preventDefault();
                let $this = $(this);
                let $input = $this.parent().prev();
                let number = parseInt($input.val());
                if (number >= 10) {
                    toastr.warning("Mỗi sản phẩm chi cho phép mua số lượng tối đa 10 sản phẩm");
                    return false;
                }
                let price = $this.parent().attr('data-price');
                let URL = $this.parent().attr('data-url')
                let productID = $this.parent().attr("data-id-product");
                number = number + 1;
                // // console.log(price * number);
                // $input.val(number);


                $.ajax({
                    url: URL,
                    data: {
                        qty: number,
                        idProduct: productID,
                    }
                }).done(function(results) {
                    if (typeof results.totalMoney !== "undefined") {
                        $input.val(number);
                        $("#sub-total").text(results.totalMoney + "đ");
                        $this.parents('tr').find(".js-total-item").text(results.totalItem + "đ");
                    } else {
                        $input.val(number - 1)
                    }
                });

            });

            $('.js-renduction').click(function(e) {
                e.preventDefault();
                let $this = $(this);
                let $input = $this.parent().prev();
                let number = parseInt($input.val());
                if(number <=1){
                    toastr.warning("Số lượng sản phẩm phải lớn hơn hoặc bằng 1");
                    return false;
                }

                // let price = $this.parent().attr('data-price');
                let URL = $this.parent().attr('data-url')
                let productID = $this.parent().attr("data-id-product");
                number = number - 1;
                // // console.log(price * number);
                // $input.val(number);
                // $this.parents('tr').find(".js-total-item").text(price * number);

                $.ajax({
                    url: URL,
                    data: {
                        qty: number,
                        idProduct: productID,
                    }
                }).done(function(results) {
                    if (typeof results.totalMoney !== "undefined") {
                        $input.val(number);
                        $("#sub-total").text(results.totalMoney + "đ");
                        $this.parents('tr').find(".js-total-item").text(results.totalItem + "đ");
                    } else {
                        $input.val(number + 1)
                    }
                });

            });

        </script>
    </div>
@endsection
