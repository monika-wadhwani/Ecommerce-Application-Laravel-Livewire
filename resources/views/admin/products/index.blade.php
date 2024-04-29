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
                    <h2>Products
                        <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm float-end">Add
                            Product</a>
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gray-500">
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        @if ($product->categories)
                                            {{ $product->categories->category_name }}
                                        @else
                                            No Category
                                        @endif
                                    </td>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->selling_price }}
                                    </td>
                                    <td>
                                        {{ $product->quantity }}
                                    </td>
                                    <td>
                                        {{ $product->status == 1 ? 'Hidden' : 'Visible' }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/products/edit/' . $product->id) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ url('admin/products/delete/' . $product->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this data.?')"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td cols="7">No Products Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div>

                        {{ $products->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
