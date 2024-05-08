<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;

class Index extends Component
{
    public $cart, $totalPriceAmount;

    public $name, $email, $address, $phone_no, $pincode, $payment_mode = Null, $payment_id = NULL;

    protected $listeners = ['validationForAll','paymentConfirmation'=>'paidOnlineOrder'];

    public function paidOnlineOrder($value){
        $this->payment_id = $value;
        $this->payment_mode = "Paid by Paypal";
        $codOrder = $this->placeOrder();
        if($codOrder){
            Cart::where('user_id', Auth::user()->id)->delete();
            session()->flash('message','Order Placed Successfully.');
            $this->dispatch('message',
                title : 'Order Placed Successfully',
                type: 'success',
                status: 200        
            );
            return redirect('thank-you');
        }
        else{
            $this->dispatch('message',
                title : 'Something Went Wrong, Try again later',
                type: 'error',
                status: 500        
            ); 
        }

    }

   
    public function validationForAll(){
        $this->validate();
    }

    public function rules(){
        return[
            'name' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'address' => 'required|max:500|string',
            'phone_no' => 'required|max:11|min:10|string',
            'pincode' => 'required|max:6|min:6|string',
        ];
    }

    public function placeOrder(){
        $validateData = $this->validate();
        $order = Order::create([
            'user_id'=> Auth::user()->id,
            'tracking_no'=>'modish-'.Str::random(10),
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'address' => $validateData['address'],
            'phone_no' => $validateData['phone_no'],
            'pincode' => $validateData['pincode'],
            'status_message' => 'in progress',
            'payment_mode' =>  $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);

        foreach($this->cart as $cartItem){
            $orderItem = OrderItem::create([
                'order_id'=> $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id'=> $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'total_price'=> $cartItem->product->selling_price
            ]);  

            if($cartItem->product_color_id != NULL){
                $cartItem->productColors()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            }else{
                $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
            }
        }    
        
       
        return $order;

    }
    public function codOrder(){
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder){
            Cart::where('user_id', Auth::user()->id)->delete();
            session()->flash('message','Order Placed Successfully.');
            $this->dispatch('message',
                title : 'Order Placed Successfully',
                type: 'success',
                status: 200        
            );
            return redirect('thank-you');
        }
        else{
            $this->dispatch('message',
                title : 'Something Went Wrong, Try again later',
                type: 'error',
                status: 500        
            ); 
        }
    }

    public function totalCount(){
        $this->totalPriceAmount = 0;
        $this->cart = Cart::where('user_id', Auth::user()->id)->get();
        foreach($this->cart as $cartItem){
         $this->totalPriceAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalPriceAmount;
    }
    public function render() 
    {   
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->totalPriceAmount = $this->totalCount();
        return view('livewire.frontend.checkout.index',['totalPriceAmount'=> $this->totalPriceAmount]);
    }
}
