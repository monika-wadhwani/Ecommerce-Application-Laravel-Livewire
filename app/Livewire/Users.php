<?php

namespace App\Livewire;

use Livewire\Component;

class Users extends Component
{
    public $names = ["monika","riya","titu"];
    public function render()
    {
        return view('livewire.users');
    }
}
