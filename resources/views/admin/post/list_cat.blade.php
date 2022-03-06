@extends('layouts/admin')

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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách danh mục
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">ID danh mục cha</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: left">
                                @php
                                    TablePostCat($post_cats);
                                @endphp

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </form>
        </div>

        @php
            function TablePostCat($post_cats, $parent_id = 0, $char = '')
            {
                $t = 0;
                foreach ($post_cats as $key => $item) {
                    $t += 1;
                    // Nếu là chuyên mục con thì hiển thị
                    if ($item->parent_id == $parent_id) {
                        echo '<td>' . $item->id . '</td>';
                        echo '<td>' . $char . $item->name . '</td>';
                        echo '<td>' . $item->parent_id . '</td>';
                        echo '<td>' . $item->created_at->format('d,m,y') . '</td>';
                        echo '<td>';
                        echo '<a href="' .
                            route('post_cat.edit', $item->id) .
                            '" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="' .
                            route('delete_post_cat', $item->id) .
                            '"
                                                    onclick="return confirm(\'Bạn có chắc chắn muốn xóa vĩnh viển danh mục này?\')"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                     data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                     class="fa fa-trash"></i></a>';
                        echo '</td>';

                        echo '</tr>';

                        // Xóa chuyên mục đã lặp
                        unset($post_cats[$key]);

                        // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                        TablePostCat($post_cats, $item->id, $char . '--');
                    }
                }
            }
        @endphp

    </div>
@endsection
