<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class DBData extends Component
{
    public $data;
    public function render()
    {  
        $this->data = Post::all();
        return view('livewire.d-b-data');
    }
}
