<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <form wire:submit.prevent="save">
        <input type="text" name = "name" placeholder="Product Name" wire:model="name">
        <button type= "submit">Add New Product</button>
    </form>
    @if(session()->has('success'))
    <h3> {{session('success')}}</h3>
   
    @endif

    <style>
        h3{
            color:green;
        }
    </style>
</div>
