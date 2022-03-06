@extends('layouts/admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật sản phẩm
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" value="{{ $product->name }}" name="name"
                                    id="name">
                                @error('name')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input class="form-control" type="text" value="{{ $product->price }}" name="price"
                                    id="price">
                                @error('price')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price_old">Giá cũ</label>
                                <input class="form-control" type="text" value="{{ $product->price_old }}" name="price_old"
                                    id="price_old">
                                @error('price_old')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="product_desc">Mô tả sản phẩm</label>
                                <textarea name="product_desc" class="form-control" id="product_desc" cols="30"
                                    rows="5">{{ $product->product_desc }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="product_detail">Chi tiết sản phẩm</label>
                        <textarea name="product_detail" class="form-control" id="product_detail" cols="30"
                            rows="5">{{ $product->product_detail }}</textarea>
                        @error('product_detail')
                            <small class="text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cat_id">Loại sản phẩm</label>
                        <select class="form-control" id="cat_id" name="cat_id">
                            @foreach ($product_types as $product_type)
                                <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="product_cat">Danh mục</label>
                        <select class="form-control" id="product_cat" name="product_cat">
                            <option value="{{ $product->product_cat }}">Chọn danh mục</option>
                            @php
                                showProductCat($product_cat);
                            @endphp
                        </select>
                    </div>

                    {{-- @foreach ($product_cat as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @if ($cat->child)
                                    @foreach ($cat->child as $child_cat)
                                        <option value="{{ $child_cat->id }}">-- {{ $child_cat->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach --}}
                    {{-- </select> --}}
                    {{-- </div> --}}

                    <div class="form-group">
                        {!! Form::label('file', 'Hình ảnh sản phẩm') !!} <label for="file" style="color: red">(Bắt buộc chọn lại hình ảnh sản
                            phẩm)</label>
                        {!! Form::file('file', ['class' => 'form-control-file', 'onchange' => 'showThumbNail(this)']) !!}
                        <img id="thumbnail" src="" alt="">
                        @error('file')
                            <small class="text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- <div class="form-group">
                    <label for="thumbnail">Hình ảnh sản phẩm</label>
                    <input type="text" name="thumbnail" value="{{ url('public') }}/{{ $product->thumbnail }}" class="form-control" id="thumbnail">
                </div> --}}

                    {{-- <div class="form-group">
                      <label for="">Hình ảnh sản phẩm</label>
                      <input type="text" name="thumbnail" id="thumbnail" class="form-control" placeholder="" aria-describedby="helpId">
                      <span class="input-group-btn">
                            <a href="#model-file" data-toggle="model" class="btn btn-default">Go</a>
                      </span>
                    </div> --}}

                    <div class="form-group">
                        {!! Form::submit('Cập nhật', ['name' => 'sm-add', 'class' => 'btn btn-primary mb-3']) !!}
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php
    function showProductCat($product_cats, $parent_id = 0, $char = '')
    {
        foreach ($product_cats as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id) {
                echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
                // Xóa chuyên mục đã lặp
                unset($product_cats[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showProductCat($product_cats, $item->id, $char . '-- ');
            }
        }
    }
    @endphp

    <script></script>
@endsection
