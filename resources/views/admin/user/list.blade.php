@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        {{-- HIỂN THI THÔNG BÁO BẰNG VONG LẶP IF KHI THÊM THÀNH VIÊN THÀNH CÔNG --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('status_danger'))
            <div class="alert alert-danger">
                {{ session('status_danger') }}
            </div>
        @endif

        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" class="form-control form-search" name="keyword"
                        value="{{ request()->input('keyword') }}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích
                    hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô hiệu
                    hóa<span class="text-muted">({{ $count[1] }})</span></a>
                {{-- <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a> --}}
            </div>
            <form action="{{ url('admin/user/action') }} " method="">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option value="">Chọn</option>
                        @foreach ($list_act as $k => $act)
                            <option value="{{ $k }}">{{ $act }}</option>
                        @endforeach
                        {{-- <option value="restore">Khôi phục</option> --}}
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">Stt</th>
                            <th scope="col">Họ tên</th>
                            {{-- <th scope="col">Username</th> --}}
                            <th scope="col">Email</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->total() > 0)
                            @php
                                $t = 0;
                            @endphp
                            @foreach ($users as $user)
                                @php
                                    $t++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                                    </td>
                                    <td scope="row">{{ $t }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_id }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                        @if (Auth::id() != $user->id)
                                            <a href="{{ route('delete_user', $user->id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viển user này?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="bg-white" style="color: red">Không tìm thấy bản ghi</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{ $users->links() }}
        </div>
    </div>
    </div>
@endsection
