@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

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
                            <h4 class="mb-0 text-white">Change Password
                                <a href="{{ url('profile') }}" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('change_password') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="mb-2">Current Password</label>
                                    <input type="password" name="current_password" class="form-control form-group">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">New Password</label>
                                    <input type="password" name="new_password" class="form-control form-group">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Confirm Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-control form-group">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button type="submit" class="btn btn-primary text-white">
                                        Update Password
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
