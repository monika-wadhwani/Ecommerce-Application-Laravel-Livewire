@extends('layouts.admin')

@section('title','Users Edit')

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
                    <h2>Edit User
                        <a href="{{ url('admin/users') }}" class="btn btn-primary text-white btn-sm float-end">Back</a>
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
                    <form action="{{ url('admin/users/update/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Name</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control form-group">
                                @error('name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Email</label>
                                <input type="email" readonly name="email" value="{{$user->email}}" class="form-control form-group">
                                @error('email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror 
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-2">Password</label>
                                <input type="password" name="password" class="form-control form-group">
                                @error('password')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                         
                            <div class="col-md-6">
                                <label class="mb-2">Select Role</label>
                                <select name="role_as" class="form-control form-group">
                                    <option value="">Select Role</option>
                                    <option value="0" {{$user->role_as == 0 ? 'selected': ''}}>User</option>
                                    <option value="1" {{$user->role_as == 1 ? 'selected': ''}}>Admin</option>
                                </select>
                                @error('role_as')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary text-white">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
