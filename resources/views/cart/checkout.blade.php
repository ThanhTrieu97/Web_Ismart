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
            <form method="GET" action="{{ route('save.cart') }}" name="form-checkout">
                @csrf
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>
                    </div>
                    <div class="section-detail">

                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="fullname" id="fullname">
                                @error('fullname')
                                    <small style="color: red" class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                                @error('email')
                                    <small style="color: red" class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row clearfix" id="address">
                            <label class="address" for='address'>Địa chỉ</label>
                            <ul class="clearfix mb-4">
                                <li class="form-col fl-left">
                                    <select name="province" id="province" class="js_loaction pos" data-type="city">
                                        <option value="">Chọn tỉnh,thành phố</option>
                                        @foreach ($citys as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('province')
                                        <small style="color: red" class="text text-danger">{{ $message }}</small>
                                    @enderror

                                </li>
                                <li class="form-col fl-right">
                                    <select name="district" id="district" data-type="district" class="js_loaction pos lef">
                                        <option>Chọn quận, huyện</option>
                                    </select>
                                    @error('district')
                                        <small style="color: red" class="text text-danger">{{ $message }}</small>
                                    @enderror

                                </li>

                            </ul>
                            <ul class="clearfix">
                                <li class="form-col fl-left">
                                    <select name="ward" id="ward" class="pos">
                                        <option>Chọn phường, xã</option>
                                    </select>
                                    @error('ward')
                                        <small style="color: red" class="text text-danger">{{ $message }}</small>
                                    @enderror

                                </li>
                                <li class="form-col fl-right pos">
                                    <input type="text" name="way" id="way" placeholder="Số nhà,tên đường" value="">
                                    @error('way')
                                        <small style="color: red" class="text text-danger">{{ $message }}</small>
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-right num">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone" id="phone">
                                @error('phone')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea class="note" name="note"></textarea>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    {{-- {{ dd($product) }} --}}
                                    <tr class="cart-item">
                                        <td class="product-name">{{ $product->name }}<strong class="product-quantity">x
                                                {{ $product->qty }}</strong>
                                        </td>
                                        <td class="product-total">{{ number_format($product->total, 0, '', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price">{{ Cart::total() }}đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                {{-- <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li> --}}
                                <li>
                                    <input type="radio" id="payment-home" name="payment-method" value="payment-home"
                                        checked>
                                    <label for="payment-home">Thanh toán tại nhà</label>
                                </li>
                            </ul>
                        </div>

                        <div class="place-order-wp clearfix">
                            <input type="submit" id="order-now" value="Đặt hàng">
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(".js_loaction").change(function(e) {
                    e.preventDefault();
                    let url = "{{ route('ajax_get.location') }}";
                    // console.log(url);
                    let $this = $(this);
                    let type = $this.attr('data-type');
                    let parentID = $this.val();
                    $.ajax({
                            method: "GET",
                            url: url,
                            data: {
                                type: type,
                                parent: parentID
                            }
                        })
                        .done(function(msg) {
                            // console.log(msg);
                            if (msg.data) {
                                let html = '';
                                let element = '';
                                if (type == 'city') {
                                    html = "<option>Chọn quận, huyện</option>";
                                    element = '#district';
                                    console.log(parentID);
                                } else {
                                    html = "<option>Chọn phường, xã</option>"
                                    element = '#ward';
                                    //  console.log(msg);

                                }

                                $.each(msg.data, function(index, value) {
                                    html += "<option value='" + value.id + "'>" + value.name +
                                        "</option>";
                                });

                                $(element).html('').append(html);
                            }
                        });

                })

            });

        </script>
    </div>
@endsection
