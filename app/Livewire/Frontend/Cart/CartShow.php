<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{
    public $cartItems, $cartQuantity, $totalPrice = 0;
    public function decrementQuantity($cartId){
        
        $cart = Cart::where('id',$cartId)->where('user_id', Auth::user()->id)->first();
        if($cart){
            if($cart->productColors()->where('id',$cart->product_color_id)->exists()){
                if($cart->productColors->quantity > $cart->quantity){
                    $cart->decrement('quantity');
                    $this->dispatch('message',
                        title : 'Quantity Updated',
                        type: 'success',
                        status: 200         
                    );
                }else{
                    $this->dispatch('message',
                        title : 'Only '.$cart->productColors->quantity. ' Quantity Available',
                        type: 'warning',
                        status: 409         
                    );
                }      
            }else{
                if($cart->product->quantity > $cart->quantity){
                    $cart->decrement('quantity');
                    $this->dispatch('message',
                        title : 'Quantity Updated',
                        type: 'success',
                        status: 200         
                    );               
                }else{
                    $this->dispatch('message',
                        title : 'Only '.$cart->product->quantity. ' Quantity Available',
                        type: 'warning',
                        status: 409         
                    );
                } 
            }           
        }else{
            $this->dispatch('message',
                title : 'Something Went Wrong',
                type: 'error',
                status: 404         
                );
        }
    }

    public function incrementQuantity($cartId){
        $cart = Cart::where('id',$cartId)->where('user_id', Auth::user()->id)->first();
        if($cart){
            if($cart->productColors()->where('id',$cart->product_color_id)->exists()){
                if($cart->productColors->quantity > $cart->quantity){
                    $cart->increment('quantity');
                    $this->dispatch('message',
                        title : 'Quantity Updated',
                        type: 'success',
                        status: 200         
                    );
                }else{
                    $this->dispatch('message',
                        title : 'Only '.$cart->productColors->quantity. ' Quantity Available',
                        type: 'warning',
                        status: 409         
                    );
                }      
            }else{
                if($cart->product->quantity > $cart->quantity){
                    $cart->increment('quantity');
                    $this->dispatch('message',
                        title : 'Quantity Updated',
                        type: 'success',
                        status: 200         
                    );               
                }else{
                    $this->dispatch('message',
                        title : 'Only '.$cart->product->quantity. ' Quantity Available',
                        type: 'warning',
                        status: 409         
                    );
                } 
            }           
        }else{
            $this->dispatch('message',
                title : 'Something Went Wrong',
                type: 'error',
                status: 404         
                );
        }
    }

    public function render()
    {
        $this->cartItems = Cart::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.cart.cart-show',['cartItems' => $this->cartItems]);
    }

    public function removeCartItem($cartId){
        if(Cart::where('user_id', Auth::user()->id)->where('id', $cartId)->exists()){
            Cart::where('user_id', Auth::user()->id)->where('id', $cartId)->delete();

            $this->dispatch('cartAddedUpdated');

            $this->dispatch('message',
                title : 'Cart Item Removed Successfully',
                type: 'success',
                status: 200        
            );
        }else{
            $this->dispatch('message',
                title : 'Something went wrong',
                type: 'error',
                status: 500        
            );
        }
    }
}
