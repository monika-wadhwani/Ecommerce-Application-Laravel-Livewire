@extends('layouts.app')

@section('title','Wishlist Items')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4 product-name">Wishlist</h4>
                </div>
                
                @livewire('frontend.wishlist.index')

            </div>
        </div>
    </div>
@endsection
