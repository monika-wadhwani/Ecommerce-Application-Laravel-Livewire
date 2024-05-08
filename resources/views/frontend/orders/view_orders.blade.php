@extends('layouts.app')

@section('title', 'My Order Details')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-3 fonts text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i>
                            <a href="{{ url('myOrders') }}" class="float-end btn btn-primary">Back</a>
                            My Order Details
                        </h4>
                        <hr>
                        <div class="row">
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
                                            $totalAmount+=$order_items->total_price * $order_items->quantity
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

            </div>
        </div>
    </div>
@endsection
