<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
   public $message = "Please Update me";
   public $counter;
 
 
   function hydrate(){
    $this->counter++;
   }
   function updateMessage($name){
    $this->message = $name;
   }


    public function render()
    {
        $data = ["name"=>"monika","email"=>"monika@gmail.com"];
        return view('livewire.counter',['data'=>$data]);
    }
}
