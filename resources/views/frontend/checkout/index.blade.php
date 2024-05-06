@extends('layouts.app')

@section('title','Cart Items')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                
                @livewire('frontend.checkout.index')

            </div>
        </div>
    </div>
@endsection