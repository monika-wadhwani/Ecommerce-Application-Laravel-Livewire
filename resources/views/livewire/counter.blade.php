<div>
    {{-- The Master doesn't talk, he acts. --}}
   @foreach ($data as $item)
      <h1> {{$item}}</h1>
   @endforeach
   {{ $message }}
   <br>
   {{$counter}}
   <br>
   <button wire:click="updateMessage('monika')">Update me !!</button>
   <input type="text" wire:model="message">
</div>
