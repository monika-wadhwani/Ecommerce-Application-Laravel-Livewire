<?php

namespace App\Livewire;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Post;

class Registration extends Component
{
    #[Validate('required',message:'Please enter a name')]
    public $name = '';
    #[Validate('required|email')]
    public $email = '';
    #[Validate('required|min:3|max:10')]
    public $password = '';

    public function render()
    {
        return view('livewire.registration');
    }

    // public function updated($field){
    //     $this->validateOnly($field,[
    //         'name'=>'required',
    //         'email'=>'required|email',
    //         'password'=>'required|min:3|max:10'
    //     ]);
    // }
    public function submit(){
    //    Post::create([
    //     'posts_name'=>$this->name
    //    ]);
    //    $this->redirect('/livewire');

        // $this->validate([
        //     'name'=>'required',
        //     'email'=>'required|email',
        //     'password'=>'required|min:3|max:10'
        // ]);

        dd($this->name, $this->email, $this->password);
    }
}
