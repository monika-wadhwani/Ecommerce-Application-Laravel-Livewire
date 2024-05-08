<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function allOrders(Request $request){
        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null, function($query) use($request){
                            return $query->whereDate('created_at',$request->date);
                        },function($query) use($todayDate){
                            $query->whereDate('created_at',$todayDate);  
                        })
                        ->when($request->status != null, function($query) use($request){
                            return $query->where('status_message',$request->status);
                        })
                        ->paginate(5);
        return view('admin.orders.my_orders',compact('orders'));
    }
    public function viewOrders($order_id){
        $order = Order::where('id',$order_id)->first();
        if($order){
            return view('admin.orders.view_orders',compact('order'));
        }else{
            return redirect()->back()->with('message','No Orders Found');
        }
    }

    public function updateOrder($order_id, Request $request){
        $order = Order::where('id',$order_id)->first();
        if($order){
            $order->update([
            'status_message'=> $request->order_status
        ]);
        return redirect('admin/show_orders/'.$order_id)->with('message','Order Status Updated');
        }else{
            return redirect('admin/show_orders/'.$order_id)->with('message','No Orders Found');
        }
    }

    public function viewInvoice($order_id){
        $order = Order::findOrFail($order_id);
        return view('admin.invoice.view-invoice',compact('order'));
    }
    public function generateInvoice($order_id){
        $order = Order::findOrFail($order_id);     
        $data = ['order'=> $order];
        $pdf = Pdf::loadView('admin.invoice.view-invoice', $data);    
     
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order_id.'-'.$todayDate.'.pdf');
    }
}
