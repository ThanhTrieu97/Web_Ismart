<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'page',
            ]);
            return $next($request);
        });
    }


    public function list_page(Request $request)
    {
        $status = $request->input('status');

        $list_act = [
            'delete' => 'Xóa tạm thời',
        ];

        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vỉnh viển',
            ];
            $pages = Page::all()->paginate(10);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $pages  = Page::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        }
        // if($request->ajax()){
        //     $detail = $request->get('data_id');
        //     echo $detail;
        // }
        // $id = $pages->id();
        // return $id;
        // $page_ajax = Page::find('id');
        // return $page_ajax;

        // $count_user_active = Page::count();
        // $count_user_trash = Page::onlyTrashed()->count();

        // $count = [$count_user_active, $count_user_trash];

        return view('admin.page.list_page', compact('pages', 'list_act'));
    }

    public function add_page()
    {

        return view('admin.page.add_page');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:100|min:2',
                'content' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài it nhất :min ký tự',
                'max' => ':attribute có độ dài it nhất :max ký tự',
            ],
            [
                'title' => 'Tiêu đề trang',
                'content' => 'Nội dung trang'
            ]
        );

        $id = Auth::id();
        $status = $request->status;
        // return $status;

        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $filename = $file->getClientOriginalName();

            //đuôi file
             $file->getClientOriginalExtension();
            //Lấy kích thuoc file
            $file->getSize();

            $path = $file->move('public/uploads/pages', $file->getClientOriginalName());
            $thumbnail = 'public/uploads/pages' . $filename;

            // $input['thumbnail'] = $thumbnail;
        }

        Page::create([
            'name' => $request->input('title'),
            'slug' =>$request->input('slug'),
            'content' => $request->input('content'),
            // 'thumbnail' => $input['thumbnail'],
            'status'=> $status,
            'user_id' => $id

        ]);
        return redirect('admin/page/list_page')->with('status', 'Đã thêm trang mới thành công');

    }

    function delete($id)
    {
        $page = Page::destroy($id);
        return redirect('admin/page/list_page')->with('status', 'Đã xóa trang thành công');
        // if (Auth::id() != $id) {

        //     // $page = Page::onlyTrashed()
        //     //     ->where('id', $id)
        //     //     ->forceDelete();
        //     // $user = User::find($id);
        //     // $user->delete();

        //     return redirect('admin/page/list_page')->with('status', 'Đã xóa trang thành công');
        // } else {
        //     return redirect('admin/page/list_page')->with('status', 'Bạn không thể tự xóa mình ra khoi hệ thống');
        // }
    }

    public function edit($id)
    {
        $page = Page::find($id);

        return view('admin.page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'title' => 'required|max:100|min:2',
                'content' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài it nhất :min ký tự',
                'max' => ':attribute có độ dài it nhất :max ký tự',
            ],
            [
                'title' => 'Tiêu đề trang',
                'content' => 'Nội dung trang'
            ]
        );
        Page::where('id', $id)->update([
            'name' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content'),

        ]);

        return redirect('admin/page/list_page')->with('status', 'Cập nhật trang thành công');
    }

}
