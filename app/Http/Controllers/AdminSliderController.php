<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'slider',
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
                $sliders = Slider::onlyTrashed()->paginate(10);
            } else {
                $keyword = "";
                if ($request->input('keyword')) {
                    $keyword = $request->input('keyword');
                }
                $sliders  = Slider::where('title', 'LIKE', "%{$keyword}%")->paginate(10);
            }

            $count_slider_active = Slider::count();
            $count_slider_trash = Slider::onlyTrashed()->count();

            $count = [$count_slider_active, $count_slider_trash];
        return view('admin.slider.list', compact('sliders', 'count', 'list_act'));
    }

    function add()
    {
        return view('admin.slider.add');
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
                'title' => 'Tiêu đề slider',
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

            $path = $file->move('public/uploads/slider/', $file->getClientOriginalName());
            $thumbnail = 'uploads/slider/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        // dd($request->all());

        $status = $request->status;
        // return $product_cat;
        Slider::create([
            'title' => $request->input('title'),
            'thumbnail' => $input['thumbnail'],
        ]);
        return redirect('admin/slider/list')->with('status', "Đã thêm slider thành công");
    }

    function delete($id)
    {
        Slider::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect('admin/slider/list')->with('status', 'Đã xóa slider thành công');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('admin.slider.edit', compact('slider'));
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
                'title' => 'Tiêu đề slider',
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

            $path = $file->move('public/uploads/slider/', $file->getClientOriginalName());
            $thumbnail = 'uploads/slider/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        Slider::where('id', $id)->update([
            'title' => $request->input('title'),
            'thumbnail' => $input['thumbnail'],
        ]);

        return redirect('admin/slider/list')->with('status', 'Cập nhật thành công');
    }

    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                // return $act;
                if ($act == 'delete') {
                    Slider::destroy($list_check);
                    return redirect('admin/slider/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    Slider::withTrashed()
                        ->where('id', $list_check)
                        ->restore();
                    return redirect('admin/slider/list')->with('status', 'Khôi phục slider thành công');
                }

                if ($act == 'forceDelete') {
                    Slider::withTrashed()
                        ->where('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/slider/list')->with('status', 'Đã xóa vĩnh viển slider');
                }

                if ($act == '') {
                    return redirect('admin/slider/list')->with('status_danger', 'Bạn cần chọn tác vụ áp dụng để thực thi');
                }
            }
            return redirect('admin/slider/list')->with('status_danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/slider/list')->with('status_danger', 'Bạn cần chọn phần tử cần thực thi');
        }
    }


}
