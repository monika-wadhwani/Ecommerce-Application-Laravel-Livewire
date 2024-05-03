<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($wishlists as $wishlist)
                            @if ($wishlist->product)
                                <div class="cart-item">
                                    <div class="row">

                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('collections/'.$wishlist->product->categories->slug.'/'. $wishlist->product->slug) }}">
                                                <label class="product-name">
                                                    <img src="{{ asset($wishlist->product->products_images[0]->image) }}"
                                                        style="width: 50px; height: 50px" alt="{{ $wishlist->product->name }}">
                                                    {{ $wishlist->product->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price"> ₹ {{ $wishlist->product->selling_price }} </label>
                                        </div>
                                        {{-- <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <span class="btn btn1"><i class="fa fa-minus"></i></span>
                                                    <input type="text" value="1" class="input-quantity" />
                                                    <span class="btn btn1"><i class="fa fa-plus"></i></span>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-4 col-12 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:click="destroyWishlistItem( {{ $wishlist->id}} )" class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove wire:target="destroyWishlistItem( {{ $wishlist->id}} )">
                                                      <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading wire:target="destroyWishlistItem( {{ $wishlist->id}} )">
                                                        <i class="fa fa-trash"></i> Removing...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col-md-12">
                                No Wishlists Found
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
