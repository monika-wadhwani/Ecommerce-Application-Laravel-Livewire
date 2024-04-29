<div>
  
    <form wire:submit.prevent ="submit">
    <h1>Users Registration</h1>
    <input type="text" placeholder="name" wire:model.live ="name">
    <span class = "error">
        @error('name') {{ $message }} @enderror
    </span>
    <br><br>
    <input type="email" placeholder="email" wire:model.live ="email">
    <span class = "error">
        @error('email') {{ $message }} @enderror
    </span><br><br>
    <input type="password" placeholder="password" wire:model.live ="password">
    <span class = "error">
        @error('password') {{ $message }} @enderror
    </span><br><br>
    <button type="submit">Register</button>
    </form>
    <style>
        .error{
            color: red
        }
    </style>
</div>

