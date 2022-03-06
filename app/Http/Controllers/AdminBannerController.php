<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class AdminBannerController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'banner',
            ]);
            return $next($request);
        });
    }

    function list(Request $request){
            $status = $request->input('status');

            $list_act = [
                'delete' => 'Xóa tạm thời',
            ];

            if ($status == 'trash') {
                $list_act = [
                    'restore' => 'Khôi phục',
                    'forceDelete' => 'Xóa vỉnh viển',
                ];
                $banners = Banner::onlyTrashed()->paginate(10);
            } else {
                $keyword = "";
                if ($request->input('keyword')) {
                    $keyword = $request->input('keyword');
                }
                $banners  = Banner::where('title', 'LIKE', "%{$keyword}%")->paginate(10);
            }

            $count_banner_active = Banner::count();
            $count_banner_trash = Banner::onlyTrashed()->count();

            $count = [$count_banner_active, $count_banner_trash];
        return view('admin.Banner.list', compact('banners', 'count', 'list_act'));
    }

    function add()
    {
        return view('admin.banner.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'file' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => 'Tiêu đề Banner',
                'file' => 'Hình ảnh bài viết',
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

            $path = $file->move('public/uploads/banner/', $file->getClientOriginalName());
            $thumbnail = 'uploads/banner/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        // dd($request->all());

        $status = $request->status;
        // return $product_cat;
        Banner::create([
            'title' => $request->input('title'),
            'thumbnail' => $input['thumbnail'],
        ]);
        return redirect('admin/banner/list')->with('status', "Đã thêm banner thành công");
    }

    function delete($id)
    {
        Banner::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect('admin/banner/list')->with('status', 'Đã xóa banner thành công');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);

        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'file' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => 'Tiêu đề banner',
                'file' => 'Hình ảnh bài viết',
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

            $path = $file->move('public/uploads/banner/', $file->getClientOriginalName());
            $thumbnail = 'uploads/banner/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        Banner::where('id', $id)->update([
            'title' => $request->input('title'),
            'thumbnail' => $input['thumbnail'],
        ]);

        return redirect('admin/banner/list')->with('status', 'Cập nhật thành công');
    }

    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                // return $act;
                if ($act == 'delete') {
                    Banner::destroy($list_check);
                    return redirect('admin/banner/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    Banner::withTrashed()
                        ->where('id', $list_check)
                        ->restore();
                    return redirect('admin/banner/list')->with('status', 'Khôi phục Banner thành công');
                }

                if ($act == 'forceDelete') {
                    Banner::withTrashed()
                        ->where('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/banner/list')->with('status', 'Đã xóa vĩnh viển Banner');
                }

                if ($act == '') {
                    return redirect('admin/banner/list')->with('status_danger', 'Bạn cần chọn tác vụ áp dụng để thực thi');
                }
            }
            return redirect('admin/banner/list')->with('status_danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/banner/list')->with('status_danger', 'Bạn cần chọn phần tử cần thực thi');
        }
    }
}
