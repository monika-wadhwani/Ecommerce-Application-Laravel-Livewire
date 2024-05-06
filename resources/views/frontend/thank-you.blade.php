@extends('layouts.app')

@section('title', 'Cart Items')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="card text-center shadow bg-white">
                <div class="card-body fonts">
                  <div>
                    @if (session('message'))
                        <h4 class="alert alert-success">{{session('message')}}</h4>
                    @endif
                    <h4>
                        Modish
                    </h4>
                  </div>
                    <div class="pb-2">
                       <h4> Thank you for shopping with Modish, Explore more..</h4>
                    </div>
                    <div>
                        <a href="{{ url('/collections') }}" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
