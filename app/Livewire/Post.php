<?php

namespace App\Livewire;
use App\Models\Product;
use Livewire\Component;

class Post extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.post');
    }
    public function save(){
        $new_product = new Product;
        $new_product->name = $this->name;
        $new_product->save();
        session()->flash('success','Product Saved Successfully');
       return redirect()->to('/livewire');
    }
}
