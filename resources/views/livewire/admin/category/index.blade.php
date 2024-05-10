<div>
    <div wire:ignore class="modal fade" id="deletedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="deleteCategory">
                    <div class="modal-body">
                        <h6>
                            Are you sure, you want to delete.?
                        </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes. Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h5 class="alert alert-success">
                    {{ session('message') }}
                </h5>
            @endif
            <div class="card">
                <div class="card-header">
                    <h2>Category
                        <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm float-end">Add
                            Category</a>
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gray-500">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        {{ $category->id }}
                                    </td>
                                    <td>
                                        {{ $category->category_name }}
                                    </td>
                                    <td>
                                        {{ $category->status == 1 ? 'Hidden' : 'Visible' }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/category/edit/' . $category->id) }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="#" wire:click="destroyCategory({{$category->id}})" data-toggle="modal" data-target="#deletedModal"
                                            class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div>

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
