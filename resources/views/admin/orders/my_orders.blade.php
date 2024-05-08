@extends('layouts.admin')

@section('title', 'My Orders')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>My Orders
                    </h2>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Filter by Date</label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ Request::get('date') ?? date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <label>Filter by Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Select All Status</option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="in progress"
                                        {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                    <option value="out-for-delivery"
                                        {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>Out for
                                        delivery</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <br />
                                <button type="submit" class="btn btn-primary">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
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
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->tracking_no }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->payment_mode }}</td>
                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $order->status_message }}</td>
                                        <td>
                                            <a href="{{ url('admin/show_orders/' . $order->id) }}"
                                                class="btn btn-primary">View</a>
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
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
