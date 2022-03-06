<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'order',
            ]);
            return $next($request);
        });
    }

    function list(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời',
            'forceDelete' => 'Xóa vỉnh viển',
            'shipping' => 'Đang giao hàng',
            'cancelled' => 'Đã hủy',
            'handled' => 'Đang xử lý',
            'finish' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',

        ];
        if ($status != "") {
            if ($status == 'trash') {
                $list_act = [
                    'restore' => 'Khôi phục',
                    'forceDelete' => 'Xóa vỉnh viển',
                ];
                $orders = Order::onlyTrashed()->paginate(10);
            }

            if ($status == 'handled') {
                $list_act = [
                    'delete' => 'Xóa tạm thời',
                    'forceDelete' => 'Xóa vỉnh viển',
                    'finish' => 'Hoàn thành',
                    'shipping' => 'Đang giao hàng',
                    'cancelled' => 'Đã hủy',
                ];
                $orders = Order::where('status', 1)->paginate(10);
            }
            if ($status == 'finish') {
                $list_act = [
                    'delete' => 'Xóa tạm thời',
                    'forceDelete' => 'Xóa vỉnh viển',
                    'shipping' => 'Đang giao hàng',
                    'cancelled' => 'Đã hủy',
                    'handled' => 'Đang xử lý',
                ];
                $orders = Order::where('status', 2)->paginate(10);
            }
            if ($status == 'shipping') {
                $list_act = [
                    'delete' => 'Xóa tạm thời',
                    'forceDelete' => 'Xóa vỉnh viển',
                    'handled' => 'Đang xử lý',
                    'cancelled' => 'Đã hủy',
                    'finish' => 'Hoàn thành',
                ];
                $orders = Order::where('status', 3)->paginate(10);
            }
            if ($status == 'cancelled') {
                $list_act = [
                    'delete' => 'Xóa tạm thời',
                    'forceDelete' => 'Xóa vỉnh viển',
                    'handled' => 'Đang xử lý',
                    'finish' => 'Hoàn thành',
                    'shipping' => 'Đang giao hàng',
                ];
                $orders = Order::where('status', 4)->paginate(10);
            }
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $orders = Order::where('customer', 'LIKE', "%{$keyword}%")->paginate(10);
        }
        // $ord = Order::first();

        // $address = Location::where('id', $ord->province, 'id', $ord->district)->get();
        // return $address;

        $count_order_active = Order::count();
        $count_order_trash = Order::onlyTrashed()->count();
        $count_order_handled = Order::where('status', 1)->count();
        $count_order_finish = Order::where('status', 2)->count();
        $count_order_shipping = Order::where('status', 3)->count();
        $count_order_cancelled = Order::where('status', 4)->count();

        $count = [$count_order_active, $count_order_trash, $count_order_handled, $count_order_finish, $count_order_shipping,  $count_order_cancelled];

        return view('admin.order.list', compact('orders', 'count', 'list_act'));
    }


    function delete($id)
    {
        Order::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect('admin/order/list')->with('status', 'Đã xóa đơn hàng thành công');
    }

    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                // return $act;
                if ($act == 'delete') {
                    Order::destroy($list_check);
                    return redirect('admin/order/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    Order::withTrashed()
                        ->where('id', $list_check)
                        ->restore();
                    return redirect('admin/order/list')->with('status', 'Khôi phục đơn hàng thành công');
                }

                if ($act == 'forceDelete') {
                    Order::withTrashed()
                        ->where('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/order/list')->with('status', 'Đã xóa vĩnh viển đơn hàng');
                }

                if ($act == 'handled') {
                    $handled = Order::find($list_check);
                    $handled->status = '0';
                    $handled->save();
                    return redirect('admin/order/list')->with('status', 'Đã chuyển đơn hàng về trang thái đang xử lý');
                }

                if ($act == 'finish') {
                    $finish = Order::find($list_check);
                    $finish->status = '1';
                    $finish->save();
                    return redirect('admin/order/list')->with('status', 'Đã chuyển đơn hàng về trang thái hoàn thành');
                }

                if ($act == 'shipping') {
                    $shipping = Order::find($list_check);
                    $shipping->status = '2';
                    $shipping->save();
                    return redirect('admin/order/list')->with('status', 'Đã chuyển đơn hàng về trang thái đang giao hàng');
                }

                if ($act == 'cancelled') {
                    $cancelled = Order::find($list_check);
                    $cancelled->status = '3';
                    $cancelled->save();
                    return redirect('admin/order/list')->with('status', 'Đã chuyển đơn hàng về trang thái hủy');
                }

                if ($act == '') {
                    return redirect('admin/order/list')->with('status_danger', 'Bạn cần chọn tác vụ áp dụng để thực thi');
                }
            }
            return redirect('admin/order/list')->with('status_danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/order/list')->with('status_danger', 'Bạn cần chọn phần tử cần thực thi');
        }
    }
}
