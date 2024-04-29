@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h5 class="alert alert-success">
                    {{ session('message') }}
                </h5>
            @endif
            <div class="card">
                <div class="card-header">
                    <h2>Add Slider
                        <a href="{{ url('admin/sliders') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
                    </h2>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ url('admin/sliders/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                       
                        <div class="mb-3">
                            <label class="mb-2">Title</label>
                            <input type="text" name="title" value="{{ $slider->title }}" class="form-control form-group">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Description</label>
                            <textarea name="description" row="3" class="form-control form-group">{{ $slider->description }}</textarea>
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Image</label>
                            <input type="file" name="image" class="form-control form-group">
                            <img src="{{ asset($slider->image) }}" alt="slider" style="width: 60px; height:60px;">
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Status</label>
                            <input type="checkbox" name="status" style="width: 30px; height: 30px;" {{$slider->status == true ? 'checked' : ''}} > <br>
                            Checked=Hidden, Un-Checked=Visible
                            @error('status')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
