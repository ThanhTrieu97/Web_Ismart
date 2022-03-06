@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật banner
            </div>
            <div class="card-body">
                <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề banner</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{ $banner->title }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Hình ảnh banner <label for="file" style="color: red">Bắt buộc chọn lại ảnh banner</label></label>
                        <input class="form-control-file" onchange="showThumbNail(this)" name="file" type="file" id="file">
                        <img id="thumbnail" src="" alt="">
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" name="btn-add" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
