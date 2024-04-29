<div>
    {{-- Be like water. --}}
   <h1>Hello Users


    @foreach ($names as $item)
       <h3>
        @livewire('users-list',['item' => $item])
        
        </h3>
      
    @endforeach
    @livewire('users-list',['item' => 'heyyy'])
   </h1>
</div>
