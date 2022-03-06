<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session([
                'module_active' => 'dashboard',
            ]);
            return $next($request);
        });
    }


    function show(){
        $orders = Order::paginate(10);
        // $data = Order::where('status', 2)->get();
        //$data =  DB::table('orders')->select('total')->where('status', 2)->get();
        // $total = DB::table('orders')->where('status', 2)->sum('total');
        $total = Order::where('status', 2)->sum('total');
        $modal = Order::paginate(10);

        $count_order_handled = Order::where('status', 1)->count();
        $count_order_finish = Order::where('status', 2)->count();
        $count_order_cancelled = Order::where('status', 4)->count();

        $count = [$count_order_handled, $count_order_finish, $count_order_cancelled];
        return view('admin.dashboard', compact('orders', 'total', 'count', 'modal'));
    }

    function detail($id){
        $detail = Order::find($id);
        // return $detail;
        return view('admin.detail', compact('detail'));
    }



}
