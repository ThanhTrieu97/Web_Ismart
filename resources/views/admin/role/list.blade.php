@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
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
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách quyền thành viên</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" name="keyword" value="{{ request()->input('keyword') }}" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kich hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{ url('admin/role/action') }}">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option>Chọn</option>
                        @foreach ($list_act as $k => $act)
                            <option value="{{ $k }}">{{ $act }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Tên quyền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->total() > 0)
                            @php
                                $t = 0;
                            @endphp
                            @foreach ($roles as $role)
                                @php
                                    $t++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $role->id }}">
                                    </td>
                                    <th scope="row">{{ $t }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>
                                        <a href="{{ route('role.edit', $role->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="{{ route('delete_role', $role->id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn role này?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="bg-while" style="color: red">Không tìm thấy bản ghi nào</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </form>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
@endsection
