<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myOrders(){
        $orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('frontend.orders.my_orders',compact('orders'));
    }
    public function viewOrders($order_id){
        $order = Order::where('user_id', Auth::user()->id)->where('id',$order_id)->first();
        if($order){
            return view('frontend.orders.view_orders',compact('order'));
        }else{
            return redirect()->back()->with('message','No Orders Found');
        }
    }
}
