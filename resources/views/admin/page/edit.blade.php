@extends('layouts/admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sủa trang
            </div>
            <div class="card-body">
                <form action="{{ route('page.update', $page->id) }}" method="POST">
                    {{-- {!! Form::open(['route' => 'page.update', $page->id,  'method' => 'POST', 'files' => true]) !!} --}}
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Tiêu đề']) !!}
                            @error('title')
                                <small class="text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('content', '', ['class' => 'form-control', 'placeholder' => 'Nội dung']) !!}
                        @error('content')
                            <small class="text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                    {!! Form::label('file', 'Ảnh đại diện') !!}
                    {!! Form::file('file', ['class' => 'form-control-file', 'onchange' => 'showThumbNail(this)']) !!}
                    <img id="thumbnail" src="" alt="">
                </div> --}}
                    {{-- <div class="form-group">
                    {!! Form::label('', 'Trạng thái') !!}
                    <div class="form-check">
                        {!! Form::radio('status', 'pending', 'checked', ['class' => 'form-check-input', 'id' => 'status1']) !!}
                        {!! Form::label('status1', 'Chờ duyệt', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form-check">
                        {!! Form::radio('status', 'public', '', ['class' => 'form-check-input', 'id' => 'status2']) !!}
                        {!! Form::label('status2', 'Công khai', ['class' => 'form-check-label']) !!}
                    </div>
                </div> --}}
                    <div class="form-group">
                        {!! Form::submit('Cập nhật', ['name' => 'sm-add', 'class' => 'btn btn-primary mb-3']) !!}
                    </div>
                    {{-- {!! Form::close() !!} --}}
                </form>
            </div>
        </div>

    @endsection
