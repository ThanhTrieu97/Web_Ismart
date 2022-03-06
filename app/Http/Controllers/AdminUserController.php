<?php

namespace App\Http\Controllers;

use App\Mail\MailUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Whoops\Run;

use function GuzzleHttp\Promise\all;

class AdminUserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'user',
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

        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vỉnh viển',
            ];
            $users = User::onlyTrashed()->paginate(10);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users  = User::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        }

        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();

        $count = [$count_user_active, $count_user_trash];


        return view('admin.user.list', compact('users', 'count', 'list_act',));
    }



    function add()
    {
        $roles = Role::all();
        return view('admin.user.add', compact('roles'));
    }


    function store(Request $request)
    {
        // if($request->input('btn-add')){
        //     return $request->input();
        // }

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài it nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Họ và tên',
                'email' => 'Email',
                'password' => "Mật khẩu",
            ]
        );
        $roles = $request->roles;
        // dd($roles);
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => $roles,
            ]);

        return redirect('admin/user/list')->with('status', "Đã thêm thành viên thành công");
    }

    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::withTrashed()
                ->where('id', $id)
                ->forceDelete();
            // $user = User::find($id);
            // $user->delete();

            return redirect('admin/user/list')->with('status', 'Đã xóa thành viên thành công');
        } else {
            return redirect('admin/user/list')->with('status', 'Bạn không thể tự xóa mình ra khoi hệ thống');
        }
    }

    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            // return $request->input('list_check');
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$k]);
                }
            }
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    User::destroy($list_check);
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->restore();
                    return redirect('admin/user/list')->with('status', 'Khôi phục tài khoản thành công');
                }

                if ($act == 'forceDelete') {
                    User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/user/list')->with('status', 'Đã xóa vĩnh viển tài khoản');
                }

                if ($act == '') {
                    return redirect('admin/user/list')->with('status_danger', 'Bạn cần chọn tác vụ áp dụng để thực thi');
                }
            }
            return redirect('admin/user/list')->with('status_danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/user/list')->with('status_danger', 'Bạn cần chọn phần tử cần thực thi');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài it nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Họ và tên',
                'password' => "Mật khẩu",
            ]
        );
        // return $request->all();
        $roles = $request->roles;
        User::where('id', $id)->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $roles,

        ]);

        return redirect('admin/user/list')->with('status', 'Cập nhật thành công');
    }
}
