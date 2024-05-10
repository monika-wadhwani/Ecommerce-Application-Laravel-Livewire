@extends('layouts.admin')

@section('title', 'My Order Details')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h4 class="alert alert-success mb-3">{{ session('message') }}</h4>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="fonts">
                        <i class="fa fa-shopping-cart text-dark"></i>
                        <a href="{{ url('admin/orders') }}" class="float-end text-white btn btn-primary">
                            <span class="fa fa-arrow-left"></span> Back</a>
                        <a href="{{ url('admin/generate_invoice/' .$order->id) }}"
                            class="float-end text-white mr-2 btn btn-primary">
                            <span class="fa fa-download"></span> Download Invoice (PDF)</a>
                        <a href="{{ url('admin/view_invoice/' .$order->id) }}" target="_blank"
                            class="float-end mr-2 btn btn-warning"><span class="fa fa-eye"></span> View Invoice</a>
                        <a href="{{ url('admin/mail_invoice/' .$order->id) }}"
                            class="float-end mr-2 btn btn-info"><span class="fa fa-eye"></span> Send Invoice via
                            Mail</a>
                        My Order Details
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6 fonts">
                            <h4 class="fonts">Order Details</h4>
                            <hr>
                            <h5 class="fonts">Order ID: {{ $order->id }}</h5>
                            <h5 class="fonts">Tracking No. {{ $order->tracking_no }}</h5>
                            <h5 class="fonts">Username: {{ $order->name }}</h5>
                            <h5 class="fonts">Payment Mode: {{ $order->payment_mode }}</h5>
                            <h5 class="fonts">Order Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h5>
                            <h5 class="border p-2 text-success fonts">Status Message:
                                <span class="text-uppercase">
                                    {{ $order->status_message }}
                                </span>
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <h4 class="fonts">User Details</h4>
                            <hr>
                            <h5 class="fonts">Full Name: {{ $order->name }}</h5>
                            <h5 class="fonts">Email: {{ $order->email }}</h5>
                            <h5 class="fonts">Phone :{{ $order->phone_no }}</h5>
                            <h5 class="fonts">Address: {{ $order->address }}</h5>
                            <h5 class="fonts">Pincode: {{ $order->pincode }}</h5>

                        </div>

                    </div>
                    <br>
                    <h2 class="fonts">Order Items</h2>
                    <hr>

                    <table class="table table-bordered table-striped">
                        <thead class="fonts">
                            <th>Order Item ID</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Product Color</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </thead>

                        <tbody>
                            @php
                                $totalAmount = 0;
                            @endphp
                            @foreach ($order->orderItems as $order_items)
                                <tr>
                                    <td>{{ $order_items->id }}</td>
                                    <td>
                                        @if ($order_items->product->products_images)
                                            <img src="{{ asset($order_items->product->products_images[0]->image) }}"
                                                style="width: 50px; height: 50px"
                                                alt="{{ $order_items->product->products_images[0]->image }}">
                                        @else
                                            <img src="" style="width: 50px; height: 50px" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $order_items->product->name }}
                                    </td>
                                    <td>
                                        @if ($order_items->productColors)
                                            @if ($order_items->productColors->color)
                                                <span>
                                                    {{ $order_items->productColors->color->name }}
                                                </span>
                                            @endif
                                        @else
                                            <h6>No Color</h6>
                                        @endif
                                    </td>
                                    <td>
                                        ₹{{ $order_items->total_price }}
                                    </td>
                                    <td>
                                        {{ $order_items->quantity }}
                                    </td>
                                    <td class="fw-bold">
                                        ₹{{ $order_items->total_price * $order_items->quantity }}
                                    </td>
                                    @php
                                        $totalAmount += $order_items->total_price * $order_items->quantity;
                                    @endphp
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td colspan="6" class="text-center">Total Amount:</td>
                                <td colspan="1">₹{{ $totalAmount }}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="card border mt-3">
                <div class="card-body">
                    <h3>Order Status Updates</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ url('admin/show_orders/' . $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <label>Update Your Order Status</label>
                                <div class="input-group">
                                    <select name="order_status" class="form-select">
                                        <option value="">Select Order Status</option>
                                        <option value="completed"
                                            {{ Request::get('status') == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="in progress"
                                            {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress
                                        </option>
                                        <option value="pending"
                                            {{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="cancelled"
                                            {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                        <option value="out-for-delivery"
                                            {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>Out for
                                            delivery</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">
                                        Update
                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-7">
                            <br />
                            <h4 class="mt-3">Current Order Status: <span
                                    class="text-uppercase">{{ $order->status_message }}</span></h4>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection
