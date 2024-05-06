<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $cartCount;

    #[On('cartAddedUpdated')] 
    public function mount(){
        if(Auth::check()){
            $this->cartCount = Cart::where('user_id',Auth::user()->id)->count();
        }else{
            $this->cartCount = 0;
        }
    }
    public function render()
    {
        return view('livewire.frontend.cart.cart-count',['cartCount' => $this->cartCount]);
    }
}
