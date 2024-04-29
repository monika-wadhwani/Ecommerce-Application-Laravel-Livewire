<?php

namespace App\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- Nothing in the world is as soft and yielding as water. --}}
            <h1>Hello from profile</h1>
        </div>
        HTML;
    }
}
