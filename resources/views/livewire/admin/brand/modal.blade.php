
    {{-- Brand Modal --}}
    <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                    <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="mb-2">Brand Name</label>
                            <input type="text" wire:model = "name" name="name" class="form-control form-group">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Brand Slug</label>
                            <input type="text" wire:model = "slug" name="slug" class="form-control form-group">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Status</label><br>
                            <input type="checkbox"wire:model="status" name="status" style="width: 20px; height:20px;">
                            Checked=Hidden, Un-Checked=Visible
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Brand Modal --}}

    {{-- Edit Modal --}}
    <div wire:ignore.self class="modal fade" id="editBrandModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
                    <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div wire:loading class="p-2">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>Loading...
                </div>
                <div wire:loading.remove>
                    <form wire:submit.prevent="updateBrand">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="mb-2">Brand Name</label>
                                <input type="text" wire:model = "name" name="name"
                                    class="form-control form-group">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2">Brand Slug</label>
                                <input type="text" wire:model = "slug" name="slug"
                                    class="form-control form-group">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2">Status</label><br>
                                <input type="checkbox" wire:model="status" name="status"
                                    style="width: 20px; height:20px;"> Checked=Hidden, Un-Checked=Visible
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- Edit Modal --}}

       {{-- Delete Modal --}}
       <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
                   <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                       aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div wire:loading class="p-2">
                   <div class="spinner-border text-primary" role="status">
                       <span class="sr-only">Loading...</span>
                   </div>Loading...
               </div>
               <div wire:loading.remove>
                   <form wire:submit.prevent="deleteBrand">
                       <div class="modal-body">
                        <h6>Are you sure you want to delete the brand.?</h6>
                       </div>
                       <div class="modal-footer">
                           <button type="button" wire:click="closeModal" class="btn btn-secondary"
                               data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Yes. Delete</button>
                       </div>
                   </form>
               </div>

           </div>
       </div>
   </div>
   {{-- Delete Modal --}}