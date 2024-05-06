<div>
    <div>
        <div class="container">
            <div>
                <h3 class="fonts">
                    My Cart
                </h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="fonts">Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4 class="fonts">Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4 class="fonts">Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4 class="fonts">Cart Subtotal</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4 class="fonts">Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($cartItems as $cart)
                            @if ($cart->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a
                                                href="{{ url('collections/' . $cart->product->categories->slug . '/' . $cart->product->slug) }}">
                                                <label class="product-name">
                                                    @if ($cart->product->products_images)
                                                        <img src="{{ asset($cart->product->products_images[0]->image) }}"
                                                            style="width: 50px; height: 50px"
                                                            alt="{{ $cart->product->products_images[0]->image }}">
                                                    @else
                                                        <img src="" style="width: 50px; height: 50px"
                                                            alt="">
                                                    @endif

                                                    {{ $cart->product->name }}
                                                    @if ($cart->productColors)
                                                        @if ($cart->productColors->color)
                                                            <span>
                                                                - Color : {{ $cart->productColors->color->name }}
                                                            </span>
                                                        @endif
                                                    @endif
                                                </label>
                                            </a>
                                        </div>

                                        <div class="col-md-1 my-auto">
                                            <label class="price">₹{{ $cart->product->selling_price }} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" class="btn btn1"
                                                        wire:click="decrementQuantity({{ $cart->id }})"
                                                        wire:loading.attr="disabled"><i
                                                            class="fa fa-minus"></i></button>

                                                    <input type="text" value="{{ $cart->quantity }}"
                                                        class="input-quantity" />

                                                    <button type="button" class="btn btn1"
                                                        wire:click="incrementQuantity({{ $cart->id }})"
                                                        wire:loading.attr="disabled"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">
                                                ₹{{ $cart->product->selling_price * $cart->quantity }}</label>
                                                @php
                                                    $totalPrice += $cart->product->selling_price * $cart->quantity
                                                @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="removeCartItem( {{ $cart->id }} )"
                                                    class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove
                                                        wire:target="removeCartItem( {{ $cart->id }} )">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading
                                                        wire:target="removeCartItem( {{ $cart->id }} )">
                                                        Removing..
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div>
                                No Cart Items Found
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mt-2 my-md-auto ">
                    <h5 class="fonts">Get the Best Deals and Offers <a href="{{ url('/collections') }}">Shop Now</a>
                    </h5>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3 ">
                        <h4 class="fonts">Total Price:
                            <span class="float-end">
                                ₹{{ $totalPrice }}
                            </span>
                            <hr>
                            <a href="{{ url('/checkout') }}" class="btn btn-warning w-100 fonts">Checkout</a>
                        </h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
