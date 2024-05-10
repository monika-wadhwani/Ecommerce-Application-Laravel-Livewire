@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <h2 class="alert alert-success">{{ session('message') }}
                </h2>
            @endif

            <div class="me-md-3 me-xl-5">
                <h2>Dashboard</h2>
                <p class="mb-md-0">Your analytics dashboard template.</p>
                <hr>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body text-white bg-primary mb-3">
                        <label>Total Order</label>
                        <h1> {{ $orders }}</h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card card-body text-white bg-success mb-3">
                        <label>Today Order</label>
                        <h1> {{ $todayOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card card-body text-white bg-warning mb-3">
                        <label>This Month Order</label>
                        <h1> {{ $monthOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card card-body text-white bg-danger mb-3">
                        <label>This year Order</label>
                        <h1> {{ $yearOrder }}</h1>
                        <a href="{{ url('admin/orders') }}" class="text-white">View</a>

                    </div>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body text-white bg-primary mb-3">
                        <label>Total Products</label>
                        <h1> {{ $totalProducts }}</h1>
                        <a href="{{ url('admin/products') }}" class="text-white">View</a>

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card card-body text-white bg-success mb-3">
                        <label>Total Categories</label>
                        <h1> {{ $totalCategory }}</h1>
                        <a href="{{ url('admin/category') }}" class="text-white">View</a>

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card card-body text-white bg-warning mb-3">
                        <label>Total Brands</label>
                        <h1> {{ $totalBrands }}</h1>
                        <a href="{{ url('admin/brands') }}" class="text-white">View</a>

                    </div>

                </div>

            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
                  <div class="card card-body text-white bg-primary mb-3">
                      <label>Total users</label>
                      <h1> {{ $allUsers }}</h1>
                      <a href="{{ url('admin/users') }}" class="text-white">View</a>

                  </div>

              </div>
              <div class="col-md-3">
                  <div class="card card-body text-white bg-success mb-3">
                      <label>Users</label>
                      <h1> {{ $totalUser }}</h1>
                      <a href="{{ url('admin/users') }}" class="text-white">View</a>

                  </div>

              </div>
              <div class="col-md-3">
                  <div class="card card-body text-white bg-warning mb-3">
                      <label>Admins</label>
                      <h1> {{ $totalAdmin }}</h1>
                      <a href="{{ url('admin/users') }}" class="text-white">View</a>

                  </div>

              </div>

          </div>
        </div>
    </div>
@endsection
