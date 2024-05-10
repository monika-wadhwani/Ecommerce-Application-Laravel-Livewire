@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>User Profile
                        <a href="{{ url('change_password') }}" class="btn btn-warning float-end">Change Password</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                <div class="col-md-10">

                    @if (session('message'))
                        <h5 class="alert alert-success">
                            {{ session('message') }}
                        </h5>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="mb-0 text-white">Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('profile') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="mb-2">Name</label>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                                            class="form-control form-group">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="mb-2">Email</label>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                                            class="form-control form-group">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="mb-2">Phone No.</label>
                                        <input type="text" name="phone" class="form-control form-group"
                                            value="{{ Auth::user()->profile->phone ?? '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="mb-2">Zip/Pincode</label>
                                        <input type="text" name="pincode"
                                            value="{{ Auth::user()->profile->pincode ?? '' }}"
                                            class="form-control form-group">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="mb-2">Address</label>
                                        <textarea type="email" name="address" class="form-control form-group">{{ Auth::user()->profile->address ?? '' }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <button type="submit" class="btn btn-primary text-white">
                                            Submit
                                        </button>
                                    </div>


                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
