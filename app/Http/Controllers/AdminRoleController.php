<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRoleController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'role',
            ]);
            return $next($request);
        });
    }

    function add_permission()
    {

        return view('admin.role.permission');
    }

    function permission(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
            ],

            [
                'require' => ':attribute không được để trống',
                'max' => 'attribute có độ dài tối đa :max ký tự',
            ],

            [
                'name' => 'Tên quyền',
            ]
        );

        Role::create([
            'name' => $request->input('name'),
        ]);
        return redirect('admin/role/list_permission')->with('status', "Đã thêm quyền mới thành công");
    }

    function list_permission(Request $request){
        $status = $request->input('status');

        $list_act = [
            'delete' => 'Xóa tạm thời',
        ];

        if($status == 'trash'){
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vỉnh viển',
            ];
            $roles = Role::onlyTrashed()->paginate(10);
        }else{
             $keyword = "";
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        $roles = Role::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        }

        $count_role_active = Role::count();
        $count_role_trash = Role::onlyTrashed()->count();

        $count = [$count_role_active, $count_role_trash];

        // $roles = Role::paginate(10);

        return view('admin.role.list', compact('roles', 'count', 'list_act'));
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
                    Role::destroy($list_check);
                    return redirect('admin/role/list_permission')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    Role::withTrashed()
                        ->whereIn('id', $list_check)
                        ->restore();
                    return redirect('admin/role/list_permission')->with('status', 'Khôi phục tài khoản thành công');
                }

                if ($act == 'forceDelete') {
                    Role::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/role/list_permission')->with('status', 'Đã xóa vĩnh viển tài khoản');
                }

                if ($act == '') {
                    return redirect('admin/role/list_permission')->with('status_danger', 'Bạn cần chọn tác vụ áp dụng để thực thi');
                }
            }
            return redirect('admin/role/list_permission')->with('status_danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/role/list_permission')->with('status_danger', 'Bạn cần chọn phần tử cần thực thi');
        }
    }

    function delete($id)
    {
        if (Auth::id() != $id) {
            $role = Role::withTrashed()
                ->where('id', $id)
                ->forceDelete();
            // $user = User::find($id);
            // $user->delete();

            return redirect('admin/role/list_permission')->with('status', 'Đã xóa thành viên thành công');
        } else {
            return redirect('admin/user/list_permission')->with('status', 'Bạn không thể tự xóa mình ra khoi hệ thống');
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('admin.role.edit_permission', compact('role'));
    }

    public function update(Request $request, $id)
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
                'name' => 'Tên quyền',
            ]
        );
        // return $request->all();
        $roles = $request->roles;
        Role::where('id', $id)->update([
            'name' => $request->input('name'),

        ]);

        return redirect('admin/role/list_permission')->with('status', 'Cập nhật quyền thành công');
    }

}
