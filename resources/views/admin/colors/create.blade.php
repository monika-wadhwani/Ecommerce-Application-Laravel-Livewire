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
                    <h2>Add Color
                        <a href="{{ url('admin/colors') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
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
                    <form action="{{ url('admin/colors/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="mb-3">
                            <label class="mb-2">Color Name</label>
                            <input type="text" name="name" class="form-control form-group">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Code</label>
                            <input type="text" name="code" class="form-control form-group">
                            @error('code')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Status</label>
                            <input type="checkbox" name="status" style="width: 40px; height: 40px;">Checked=Hidden, Un-Checked=Visible
                            @error('status')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    
                        <div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
