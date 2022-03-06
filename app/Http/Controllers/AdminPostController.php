<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Post_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'post',
            ]);
            return $next($request);
        });
    }

    function list(Request $request)
    {
        $status = $request->input('status');

        $list_act = [
            'delete' => 'Xóa tạm thời',
        ];
        if ($status  != "") {
            if ($status == 'trash') {
                $list_act = [
                    'restore' => 'Khôi phục',
                    'forceDelete' => 'Xóa vỉnh viển',
                ];
                $posts = Post::onlyTrashed()->paginate(10);
            }
            if ($status == 'public') {
                $list_act = [
                    'pending' => 'Chờ duyệt',
                ];
                $posts = Post::where('status', 2)->paginate(10);
            }
            if ($status == 'pending') {
                $list_act = [
                    'public' => 'Công khai',
                ];
                $posts = Post::where('status', 1)->paginate(10);
            }
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $posts  = Post::where('title', 'LIKE', "%{$keyword}%")->paginate(10);
        }

        $count_post_active = Post::count();
        $count_post_trash = Post::onlyTrashed()->count();
        $count_product_public = Post::where('status', 2)->count();
        $count_product_pending = Post::where('status', 1)->count();

        $count = [$count_post_active, $count_post_trash, $count_product_public, $count_product_pending];

        return view('admin.post.list', compact('posts', 'count', 'list_act'));
    }

    function add()
    {
        $post_cat = Post_cat::all();
        $pages = Page::all();
        return view('admin.post.add', compact('post_cat', 'pages'));
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'content' => 'Nội dung bài viết',
            ],
        );
        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $filename = $file->getClientOriginalName();

            //đuôi file
            $file->getClientOriginalExtension();
            //Lấy kích thuoc file
            $file->getSize();

            $path = $file->move('public/uploads/post/', $file->getClientOriginalName());
            $thumbnail = 'uploads/post/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        // dd($request->all());

        $status = $request->status;
        // return $product_cat;
        Post::create([
            'title' => $request->input('title'),
            'post_desc' => $request->input('post_desc'),
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'page_id' => $request->input('page_id'),
            'thumbnail' => $input['thumbnail'],
            'status' => $status,
        ]);
        return redirect('admin/post/list')->with('status', "Đã thêm bài viết thành công");
    }

    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                // return $act;
                if ($act == 'delete') {
                    Post::destroy($list_check);
                    return redirect('admin/post/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    Post::withTrashed()
                        ->where('id', $list_check)
                        ->restore();
                    return redirect('admin/post/list')->with('status', 'Khôi phục bài viết thành công');
                }

                if ($act == 'forceDelete') {
                    Post::withTrashed()
                        ->where('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/post/list')->with('status', 'Đã xóa vĩnh viển bài viết');
                }

                if ($act == 'pending') {
                    $pending = Post::find($list_check);
                    $pending->status = '0';
                    $pending->save();
                    return redirect('admin/post/list')->with('status', 'Đã chuyển bài viết về trang thái Chờ duyệt');
                }

                if ($act == 'public') {
                    $public = Post::find($list_check);
                    // return $public;
                    $public->status = '1';
                    $public->save();
                    return redirect('admin/post/list')->with('status', 'Đã chuyển bài viết về trang thái Công khai');
                }

                if ($act == '') {
                    return redirect('admin/post/list')->with('status_danger', 'Bạn cần chọn tác vụ áp dụng để thực thi');
                }
            }
            return redirect('admin/post/list')->with('status_danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/post/list')->with('status_danger', 'Bạn cần chọn phần tử cần thực thi');
        }
    }

    function delete($id)
    {
        Post::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect('admin/post/list')->with('status', 'Đã xóa bài viết thành công');
    }

    function edit($id)
    {   $pages = Page::all();
        $post_cat = Post_cat::all();
        $post = Post::find($id);
        return view('admin/post/edit', compact('post', 'post_cat', 'pages'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'content' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'content' => 'Nội dung bài viết',
            ],
        );

        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $filename = $file->getClientOriginalName();

            //đuôi file
            $file->getClientOriginalExtension();
            //Lấy kích thuoc file
            $file->getSize();

            $path = $file->move('public/uploads/product/', $file->getClientOriginalName());
            $thumbnail = 'uploads/product/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        Post::where('id', $id)->update([
            'title' => $request->input('title'),
            'post_desc' => $request->input('post_desc'),
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'page_id' => $request->input('page_id'),
            'thumbnail' => $input['thumbnail'],
        ]);
        // return $thumbnail;
        return redirect('admin/post/list')->with('status', "Đã cập nhật bài viết thành công");

    }
    # PHẦN DANH MỤC BÀI VIẾT

    function list_cat()
    {
        $post_cats = Post_cat::paginate(10);
        return view('admin.post.list_cat', compact('post_cats'));
    }

    function add_cat()
    {
        $post_cats = Post_cat::all();
        return view('admin.post.add_cat', compact('post_cats'));
    }

    function store_cat(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh muc',
            ],
        );

        // return $request->parent_id;
        Post_cat::create([
            'name' => $request->input('name'),
            'parent_id' => $request->parent_id,
        ]);
        return redirect('admin/post/list_cat')->with('status', "Đã thêm danh mục thành công");
    }

    function delete_cat($id)
    {
        Post_cat::destroy($id);
        return redirect('admin/post/list_cat')->with('status', 'Đã xóa danh mục thành công');
    }

    function edit_cat($id)
    {
        $post_cats = Post_cat::all();
        $post_cat = Post_cat::find($id);
        // return $product_cat;
        return view('admin.post.edit_cat', compact('post_cats', 'post_cat'));
    }

    function update_cat(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh muc',
            ],
        );

        // return $request->parent_id;
        Post_cat::where('id', $id)->update([
            'name' => $request->input('name'),
            'parent_id' => $request->parent_id,
        ]);
        return redirect('admin/post/list_cat')->with('status', "Đã cập nhật danh mục thành công");
    }
}
