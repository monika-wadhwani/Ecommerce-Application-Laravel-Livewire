@extends('layouts.app')

@section('title', 'All Categories')

@section('content')

    <div class="py3 py-md-5 bg-light">
        <div class="container card-container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">
                    Our Categories
                    </h4>               
                </div>
                @forelse ($categories as $category)
                <div class="col-6 col-md-3">
                    <div class="category-card cards">
                        <a href=" {{url('collections/'.$category->slug)}} ">
                            <div class="category-card-img">
                                <img src="{{asset($category->images)}}" class="w-100" alt="category">
                            </div>
                            <div class="category-card-body">

                                <h5>{{$category->category_name}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">No Categories Found</div>
                @endforelse
            </div>
        </div>
    </div>


@endsection
