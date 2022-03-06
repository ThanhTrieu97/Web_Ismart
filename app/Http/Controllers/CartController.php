<?php

namespace App\Http\Controllers;

use App\Mail\Shopping;
use App\Models\Location;
use App\Models\Order;
use App\Models\Product;
use Aws\Common\Enum\Region;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class CartController extends Controller
{
    //
    function show()
    {

        return view('cart.show');
    }


    public function add_cart(Request $request, $id)
    {
        $product = Product::find($id);
        // Cart::destroy();

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => ['thumbnail' => $product->thumbnail]
        ]);
        // echo "<pre>";
        // print_r(Cart::content());
        // echo "</pre>";

        return redirect('cart/show');
    }

    function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('cart/show');
    }

    function destroy()
    {
        Cart::destroy();
        return redirect('cart/show');
    }

    function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $qty = $request->qty ?? 1;
            $idProduct = $request->idProduct;
            $product = Product::find($idProduct);

            if (!$product) return response([
                'messages' => 'Không tồn tại sản phẩm cần update',
            ]);

            // if($product->pro_number < $qty){
            //     return response([
            //         'messages' => 'Số lượng cập nhật không đủ',
            //         'error' => true,
            //     ]);
            // }


            Cart::update($id, $qty);

            return response([
                // 'messages' => 'Cập nhật thành công',
                'totalMoney' => Cart::total(0),
                'totalItem' => number_format($product->price * $qty, 0, '', '.'),
            ]);
        }
    }

    function cart_update(Request $request)
    {
        $data = $request->get('qty');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }

        return redirect('cart/show');
    }


    function checkout()
    {
        $citys = Location::where('type', 1)->get();

        $products = Cart::content();
        // return $products;



        return view('cart.checkout', compact('citys', 'products'));
    }

    function getLocation(Request $request)
    {
        // return $request;
        $parentID = $request->parent;
        // return $parentID;
        if ($parentID) {
            $locations = Location::where('parent_id', $parentID)->get();
            return response([
                'data' => $locations,
            ]);
        }
    }

    function saveInfoCart(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|max:100|min:2',
                'email' => 'required',
                'district' => 'required',
                'province' => 'required',
                'ward' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài it nhất :min ký tự',
                'max' => ':attribute có độ dài it nhất :max ký tự',
            ],
            [
                'fullname' => 'Họ tên',
                'email' => 'Email',
                'district' => 'QUận, huyện',
                'province' => 'Tỉnh, thành phố',
                'ward' => 'Phường, xã',
                'way' => 'Số nhà, tên đường'
            ]
        );
        $province = Location::where('id', $request->province)->first();
        $district = Location::where('id', $request->district)->first();
        $ward = Location::where('id', $request->ward)->first();
        //    $way = Location::where('id', $request->way)->first();
        //    return $province;
        $products = Cart::content();

        // return $products;
        foreach ($products as $product) {
            $code = 'ISMART' . $product->id;
            $totalMoney = Cart::total();
            $order = Order::insert([
                'total' => $totalMoney,
                'note' => $request->note,
                'customer' => $request->fullname,
                'email' => $request->email,
                'province' => $province->name,
                'district' => $district->name,
                'ward' => $ward->name,
                'way' => $request->way,
                'phone_number' => $request->phone,
                'code' => $code,
                'image' => $product->options->thumbnail,
                'number_order' => $product->qty,
                'product_id' => $product->id,
                'created_at' => $request->created_at,
            ]);
        }
        $data = [
            'name' => $request->fullname,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'province' => $province->name,
            'district' => $district->name,
            'ward' => $ward->name,
            'way' => $request->way,
            'shopping' => Cart::content()
        ];
        // return $data;


        Mail::to($request->email)->send(new Shopping($data));

        Cart::destroy();

        return view('cart/success');
    }
}
