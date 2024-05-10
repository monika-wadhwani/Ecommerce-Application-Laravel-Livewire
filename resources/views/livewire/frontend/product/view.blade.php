<div>
    <div class="py-3 py-md-5">
        <div class="container">
            {{-- @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif --}}
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->products_images->count() > 0)
                            {{-- <img src="{{ asset($product->products_images[0]->image) }}" class="w-100" alt="Img"> --}}
                            <div class="exzoom" id="exzoom">
                                <!-- Images -->
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($product->products_images as $images)
                                            <li><img src="{{ asset($images->image) }}"></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn">
                                        < </a>
                                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            No Images Available
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}

                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->categories->category_name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">₹{{ $product->selling_price }}</span>
                            <span class="original-price">₹{{ $product->original_price }}</span>
                        </div>
                        <div class="mt-2">
                            @if ($product->productColors->count() > 0)
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        {{-- <input type="radio" name="colorItem" value="{{ $colorItem->id }}">
                                        {{ $colorItem->color->name }} --}}
                                        <label class="colorSelectedItem"
                                            style="background-color: {{ $colorItem->color->code }}"
                                            wire:click="selectedColor( {{ $colorItem->id }} )">
                                            {{ $colorItem->color->name }}
                                        </label>
                                    @endforeach
                                    <div>
                                        @if ($this->productColorQuantity == 'outOfStock')
                                            <label class="btn-sm stock-css bg-danger">Out of Stock</label>
                                        @elseif($this->productColorQuantity > 0)
                                            <label class="btn-sm stock-css bg-success">In Stock</label>
                                        @endif
                                    </div>

                                @endif
                            @else
                                @if ($product->quantity > 0)
                                    <label class="btn-sm stock-css bg-success">In Stock</label>
                                @else
                                    <label class="btn-sm stock-css bg-danger">Out of Stock</label>
                                @endif
                            @endif

                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model.live="quantityCount" value="{{ $this->quantityCount }}"
                                    readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn1" wire:click="addToCart( {{ $product->id }} )"> <i
                                    class="fa fa-shopping-cart"></i> Add To Cart</button>

                            <button type="button" wire:click="addToWishlist( {{ $product->id }} )" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishlist">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishlist">
                                    Adding...
                                </span>
                            </button>

                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->long_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h4>
                        Related
                        @if ($category)
                            {{ $category->category_name }}
                        @endif
                        Products
                    </h4>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if ($category)
                        <div class="owl-carousel owl-theme related-products">
                            @foreach ($category->related_products as $related_product)
                                <div class="item mb-3">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($related_product->products_images->count() > 0)
                                                <a
                                                    href="{{ url('collections/' . $related_product->categories->slug . '/' . $related_product->slug) }}">
                                                    <img src="{{ asset($related_product->products_images[0]->image) }}"
                                                        alt=" {{ $related_product->name }}">
                                                </a>
                                            @endif

                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $related_product->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('collections/' . $related_product->categories->slug . '/' . $related_product->slug) }}">
                                                    {{ $related_product->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">
                                                    ₹{{ $related_product->selling_price }}</span>
                                                <span
                                                    class="original-price">₹{{ $related_product->original_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-md-12">
                            No Related Products Available
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
    <div class="py-3 py-md-5 ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h4>
                        Related
                        @if ($product)
                            {{ $product->brand }}
                        @endif
                        Products
                    </h4>
                    <div class="underline"></div>
                </div>

                <div class="col-md-12">
                    @if ($category)
                        <div class="owl-carousel owl-theme related-products">
                            @foreach ($category->related_products as $related_product)
                                @if ($related_product->brand == $product->brand)
                                    <div class="item mb-3">
                                        <div class="product-card">

                                            <div class="product-card-img">
                                                @if ($related_product->products_images->count() > 0)
                                                    <a
                                                        href="{{ url('collections/' . $related_product->categories->slug . '/' . $related_product->slug) }}">
                                                        <img src="{{ asset($related_product->products_images[0]->image) }}"
                                                            alt=" {{ $related_product->name }}">
                                                    </a>
                                                @endif

                                            </div>
                                            <div class="product-card-body">
                                                <p class="product-brand">{{ $related_product->brand }}</p>
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ url('collections/' . $related_product->categories->slug . '/' . $related_product->slug) }}">
                                                        {{ $related_product->name }}
                                                    </a>
                                                </h5>
                                                <div>
                                                    <span class="selling-price">
                                                        ₹{{ $related_product->selling_price }}</span>
                                                    <span
                                                        class="original-price">₹{{ $related_product->original_price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @else
                            <div class="col-md-12">
                                No Related Products Available
                            </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function() {

                $("#exzoom").exzoom({
                    "navWidth": 60,
                    "navHeight": 60,
                    "navItemNum": 5,
                    "navItemMargin": 7,
                    "navBorder": 1,

                    // autoplay
                    "autoPlay": false,

                    // autoplay interval in milliseconds
                    "autoPlayTimeout": 2000

                });

            });

            $('.related-products').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        </script>
    @endpush
