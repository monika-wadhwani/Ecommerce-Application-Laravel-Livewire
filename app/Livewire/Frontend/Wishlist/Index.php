<?php

namespace App\Livewire\Frontend\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function render()
    {
        $wishlists = Wishlist::where('user_id',Auth::user()->id)->get();
        return view('livewire.frontend.wishlist.index',['wishlists'=> $wishlists]);
    }
    public function destroyWishlistItem($wishlistID){
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->findOrFail($wishlistID);
        $this->dispatch('wishlistAddedUpdated'); 
        $wishlist->delete();
        $this->dispatch('message',
        title : 'Wishlist Removed Successfully.',
        type: 'success',
        status: 200         
        );
    }
}
