<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $productColorQuantity, $quantityCount = 1, $productColorId;
    
    public function render()
    {
        return view('livewire.frontend.product.view',['category'=>$this->category, 'product'=>$this->product]);
    }
    
    public function decrementQuantity(){
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }

    public function incrementQuantity(){
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }

    public function mount($category, $product){
        $this->category = $category;
        $this->product = $product;
    }
   
    public function selectedColor($colorId){
        $this->productColorId = $colorId;  
        $productColor = $this->product->productColors()->where('id',$colorId)->first();
        $this->productColorQuantity = $productColor->quantity;
        
        if($this->productColorQuantity == 0){
            $this->productColorQuantity = 'outOfStock';
        }
    }

    public function addToWishlist($productID){
        if(Auth::check()){
            if(!Wishlist::where('user_id', Auth::user()->id)->where('product_id', $productID)->exists()){
                Wishlist::create([
                    'user_id'=> Auth::user()->id,
                    'product_id'=>$productID
                ]);
                $this->dispatch('wishlistAddedUpdated');
                session()->flash('message','Added in Wishlist Successfully');
                $this->dispatch('message',
                    title : 'Added in Wishlist Successfully',
                    type: 'success',
                    status: 409         
                );
                return true;
            }
            else{
                session()->flash('message','Already Added in Wishlist.');
                $this->dispatch('message',
                    title : 'Already Added in Wishlist.',
                    type: 'warning',
                    status: 401         
                );
                return false;
            }
           

            return redirect()->back();
        }
        else{
            session()->flash('message','Please Login to Continue');
            $this->dispatch('message',
                title : 'Please Login to Continue',
                type: 'info',
                status: 401
                
            );
            return false;
        }
        
    }

    public function addToCart($productID){      
        if(Auth::check()){
            // dd($this->product->id);
             // !Cart::where('user_id', Auth::user()->id)->where('product_id', $productID)->where('status',0)->exists()              

            if($this->product->where('id', $productID)->where('status',0)->exists()){
                //check product colors available and add to cart
                if($this->product->productColors->count() > 0){
                    // dd('product colors');
                    if($this->productColorQuantity != NULL){
                     //   dd("product color");
                        if(Cart::where('user_id', Auth::user()->id)->where('product_id', $productID)->where('product_color_id',$this->productColorId)->exists()){
                          
                            $cartData = Cart::where('user_id', Auth::user()->id)->where('product_id', $productID)->where('product_color_id',$this->productColorId)->first();

                            $productColorQuantity = $this->product->productColors->where('id', $this->productColorId)->first();

                            if($productColorQuantity->quantity >= $this->quantityCount){

                                if($cartData->quantity == $productColorQuantity->quantity){
                                    $this->dispatch('message',
                                        title : 'Product Already Available in Cart',
                                        type: 'warning',
                                        status: 200           
                                    );
                                }else{
                                    Cart::where('user_id', Auth::user()->id)->where('product_id', $productID)->where('product_color_id',$this->productColorId)->update([
                                        'user_id'=> Auth::user()->id,
                                        'product_id'=>$productID,
                                        'quantity' => $this->quantityCount + $cartData->quantity,    
                                    ]);
                                    $this->dispatch('message',
                                        title : 'Product Added To Cart',
                                        type: 'success',
                                        status: 200           
                                    );
                                }
                               
                            }else{
                                // dd($this->quantityCount);
                                $this->dispatch('message',
                                    title : 'Only '.$productColorQuantity->quantity.' Quantity Available',
                                    type: 'warning',
                                    status: 409         
                                ); 
                            }
                           
                        }else{
                            $productColorQuantity = $this->product->productColors->where('id', $this->productColorId)->first();
                           
                            if($productColorQuantity->quantity > 0){
                                if($productColorQuantity->quantity >= $this->quantityCount){
                                    Cart::create([
                                        'user_id'=> Auth::user()->id,
                                        'product_id'=>$productID,
                                        'quantity' => $this->quantityCount,
                                        'product_color_id' => $this->productColorId ?? null                                       
                                    ]);

                                    $this->dispatch('cartAddedUpdated');

                                    $this->dispatch('message',
                                        title :'Product Added To Cart',
                                        type: 'success',
                                        status: 409         
                                    ); 
                                }
                                else{
                                    $this->dispatch('message',
                                        title : 'Only '.$productColorQuantity->quantity.' Quantity Available',
                                        type: 'warning',
                                        status: 409         
                                    );   
                                }
                            }else{
                                
                                $this->dispatch('message',
                                    title : 'Out Of Stock',
                                    type: 'warning',
                                    status: 409         
                                );  
                            }  
                        }
                                             
                    }
                    else{
                        //  dd($this->productColorQuantity);
                        $this->dispatch('message',
                        title : 'Please Select Your Color.',
                        type: 'info',
                        status: 401                   
                        );    
                    }                        
                }
                else{      
                   // dd("product quantity");
                    if(Cart::where('user_id', Auth::user()->id)->where('product_id', $productID)->exists()){
                        if($this->product->quantity > $this->quantityCount){
                            $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $productID)->first();
                            Cart::where('user_id', Auth::user()->id)->where('product_id', $productID)->update([
                                'user_id'=> Auth::user()->id,
                                'product_id'=>$productID,
                                'quantity' => $this->quantityCount + $cart->quantity,    
                            ]);
                            $this->dispatch('message',
                                title : 'Product Added To Cart',
                                type: 'success',
                                status: 200           
                            );
                        }
                        else{
                            $this->dispatch('message',
                            title : 'Only '.$this->product->quantity.' Quantity Available',
                            type: 'warning',
                            status: 409         
                        );   
                        }
                       
                    }
                    else
                    {
                        if($this->product->quantity > 0){
                            if($this->product->quantity > $this->quantityCount){
                                Cart::create([
                                    'user_id'=> Auth::user()->id,
                                    'product_id'=>$productID,
                                    'quantity' => $this->quantityCount,    
                                ]);

                                $this->dispatch('cartAddedUpdated');
                                
                                $this->dispatch('message',
                                    title : 'Product Added To Cart',
                                    type: 'success',
                                    status: 200         
                                );  
                        
                            }
                            else{
                                $this->dispatch('message',
                                    title : 'Only '.$this->product->quantity.' Quantity Available',
                                    type: 'warning',
                                    status: 409         
                                );     
                            } 
                        }
                        else{
                            $this->dispatch('message',
                                title : 'Out Of Stock',
                                type: 'warning',
                                status: 409         
                            );     
                        }   
                    }        
                    
                }                             
            }
            else{
             
                $this->dispatch('message',
                    title : 'Product is No longer Available.',
                    type: 'warning',
                    status: 404         
                );
               
            }
            return redirect()->back();
        }
        else{

            $this->dispatch('message',
                title : 'Please Login to Continue',
                type: 'info',
                status: 401
                
            );    
        }
    }
}
