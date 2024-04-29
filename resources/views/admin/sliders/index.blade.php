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
                    <h2>Sliders List
                        <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm float-end">Add
                            Slider</a>
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gray-500">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>                            
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $slider->title }}
                                    </td>
                                    <td>
                                        {{ $slider->description }}
                                    </td>
                                    <td>
                                        {{ $slider->status == 1 ? 'Hidden' : 'Visible' }}
                                    </td>
                                    <td>
                                        <img src="{{asset($slider->image)}}" alt="slider" style="height:70px; width:70px">
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/sliders/edit/' . $slider->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ url('admin/sliders/delete/' . $slider->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this data.?')"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No Slider Found</td>
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
