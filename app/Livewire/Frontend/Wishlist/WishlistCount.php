<?php

namespace App\Livewire\Frontend\Wishlist;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    public $wishlistCount; 
    #[On('wishlistAddedUpdated')] 
    public function mount(){
        if(Auth::check()){
            $this->wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        }else{
            $this->wishlistCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.frontend.wishlist.wishlist-count',['wishlistCount',$this->wishlistCount]);
    }
}
