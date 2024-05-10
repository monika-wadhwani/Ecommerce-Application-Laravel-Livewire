@extends('layouts.admin')

@section('title','Users List')

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
                        <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm float-end">Add
                            User</a>
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gray-500">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                        
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        @if ($user->role_as == 1)                                            
                                        <label class="badge btn-success">Admin</label>
                                        @elseif($user->role_as == 0)
                                        <label class="badge btn-primary">User</label>
                                        @else
                                        <label class="badge btn-danger">None</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/edit/' . $user->id) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ url('admin/users/delete/' . $user->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this data.?')"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Users Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                <div>
                    {{ $users->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
