@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="shadow-bg-white p-3">
                        <h4 class="mb-3 fonts">
                            My Orders
                        </h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Order Id</th>
                                    <th>Tracking No.</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Order Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->tracking_no}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->payment_mode}}</td>
                                        <td>{{$order->created_at->format('d-m-Y')}}</td>
                                        <td>{{$order->status_message}}</td>
                                        <td>
                                            <a href="{{url('orders/'.$order->id)}}" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @empty
                                        <div>
                                          <td colspan="7">
                                            No Orders is Placed
                                          </td>
                                        </div>
                                    @endforelse
                                   
                                </tbody>
                                
                            </table>
                            <div>
                                {{$orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
