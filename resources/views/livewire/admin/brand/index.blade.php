<div>

    @include('livewire.admin.brand.modal')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h5 class="alert alert-success">
                    {{ session('message') }}
                </h5>
            @endif
            <div class="card">
                <div class="card-header">
                    <h2>Brands List
                        <a href="#" data-toggle="modal" data-target="#addBrandModal"
                            class="btn btn-primary btn-sm float-end">Add
                            Brand</a>
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gray-500">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>
                                        {{ $brand->id }}
                                    </td>
                                    <td>
                                        {{ $brand->name }}
                                    </td>
                                    <td>
                                        {{ $brand->slug }}
                                    </td>
                                    <td>
                                        {{ $brand->status == '1' ? 'Hidden' : 'Visible' }}
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal"
                                            wire:click="editBrand({{ $brand->id }})" data-target="#editBrandModal"
                                            class="btn btn-success">Edit</a>
                                        <a href="#" wire:click="destroyBrand({{ $brand->id }})"
                                            data-toggle="modal" data-target="#deleteBrandModal"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Brands Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
