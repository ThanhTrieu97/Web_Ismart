<div>
    <div id="m_269765262325379365wp-mail" style="width:800px;margin:0px auto">
        <div>
            <div style="text-align:center;background-color:red">
                <a style="color:white;display:block;padding:5px 0px;text-decoration:none" target="_blank"
                    data-saferedirecturl="">
                    <h2>ISMART</h2>
                </a>
            </div>

            <h3 style="color:red;margin-top:30px;text-align:center">Cám ơn bạn đã đặt hàng tại ISMART</h3>
            <h4>Xin chào {{ $name }}</h4>
            <p>ISMART đã nhận được yêu cầu đặt hàng của bạn và đang xử lý nhé. Bạn sẽ nhận được thông báo tiếp theo
                khi
                đơn hàng đã sẵn sàng được giao</p>
            <h4 style="margin-top:30px">Đơn hàng được giao đến</h4>
            <table id="" style="width:100%;margin-bottom:20px">
                <tbody>
                    <tr>
                        <td style="width:30%">Tên</td>
                        <td style="width:70%">{{ $name }}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">Địa chỉ</td>
                        <td style="width:70%">
                            {{ $way }}-{{ $ward }}-{{ $district }}-{{ $province }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%">Điện thoại</td>
                        <td style="width:70%">{{ $phone_number }}</td>
                    </tr>
                    <tr>
                        <td style="width:30%">Email</td>
                        <td style="width:70%"><a href="{{ $email }}"
                                target="_blank">{{ $email }}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
                <table id="" style="width:100%;text-align:center">
                    <thead>

                        <tr>
                            <th style="width:20%">Mã đơn hàng</th>
                            <th style="width:50%">Tên sản phẩm
                            </th>
                            <th style="width:10%">Số lượng</th>
                            <th style="width:20%">Giá tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($shopping as $row)
                        <tr>
                            <td>ISMART{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->qty }}</td>
                            <td>{{ number_format($row->price, 0, '', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <strong style="margin:20px 0px 0px 590px;color:red">Tổng cộng: {{ Cart::total() }}đ </strong>
            <p>Phương thức thanh toán: thanh toán tại nhà</p>
            <h4 style="color:red;margin-top:30px">Mọi thắc mắc vui lòng liên hệ hotline:</h4>
            <p style="color:red">SĐT: 0962563254</p>
            <p style="color:red">Email: <a href="mailto:trieupt060697@gmail.com"
                    target="_blank">trieupt060697@gmail.com</a></p>
            <div class="adL">
            </div>
        </div>
        <div class="adL">
        </div>
    </div>
    <div class="adL">
    </div>
</div>
<div class="adL">




</div>
</div>
</div>
<div id=":o7" class="ii gt" style="display:none">
    <div id=":o6" class="a3s aiL undefined"></div>
</div>
<div class="hi"></div>
</div>
