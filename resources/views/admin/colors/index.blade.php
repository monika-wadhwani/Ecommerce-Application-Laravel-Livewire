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
                    <h2>Colors List
                        <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm float-end">Add
                            Color</a>
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gray-500">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($colors as $color)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $color->name }}
                                    </td>
                                    <td>
                                        {{ $color->code }}
                                    </td>
                                    <td>
                                        {{ $color->status == 1 ? 'Hidden' : 'Visible' }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/colors/edit/' . $color->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ url('admin/colors/delete/' . $color->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this data.?')"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td cols="5">No Products Found</td>
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
