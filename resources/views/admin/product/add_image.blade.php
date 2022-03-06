@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm thư viện ảnh
            </div>
            <div class="card-body">
                <form action="{{ url('admin/product/store_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên ảnh slider</label>
                        <input class="form-control" type="text" name="name" id="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Thuộc sản phẩm</label>
                        <select class="form-control" id="" name="product_id">
                            @foreach ($product_images as $product_image)
                                <option value="{{ $product_image->id }}">{{ $product_image->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">Hình ảnh slider của sản phẩm</label>
                        <input  class="form-control-file" onchange="showThumbNail(this)" name="file" type="file" id="file">
                        <img id="thumbnail" src="" alt="">
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
