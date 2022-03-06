@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm quyền quản lý người dùng
            </div>
            <div class="card-body">
                <form action="{{ url('admin/role/permission') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên quyền</label>
                        <input class="form-control" type="text" name="name" id="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
