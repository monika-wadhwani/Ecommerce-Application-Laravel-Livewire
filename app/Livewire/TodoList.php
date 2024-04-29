<?php

namespace App\Livewire;
use App\Models\Todo;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Rule('required|min:3|max:100')]
    public $name;

    public $search;

    public $editedTodoID;

    #[Rule('required|min:3|max:100')]
    public $editedTodoName;

    public function create(){
        
        $validated = $this->validateOnly('name');
        
        Todo::create($validated);
        
        $this->reset('name');

        session()->flash('success','Todo Saved Successfully.');

        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.todo-list',[
            'todos' => Todo::latest()->where('name','like',"%{$this->search}%")->paginate(5)
        ]);
    }

    public function delete($todoId){
        try{
            $todo_delete = Todo::findOrFail($todoId);
            $todo_delete->delete();
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            
            session()->flash('error','Failed to delete todo');
            return;
        }
    }

    public function toggle($todoID){
        $todo = Todo::find($todoID);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    
    public function edit($todoID){
        $this->editedTodoID = $todoID;
        $this->editedTodoName = Todo::find($todoID)->name;
    }

    public function update(){
        $this->validateOnly('editedTodoName');
        $todo = Todo::find($this->editedTodoID);
        $todo->name = $this->editedTodoName;
        $todo->save();

        $this->cancel();
        session()->flash('updated','Updated Successfully');
    }

    public function cancel(){
        $this->reset('editedTodoID','editedTodoName');
    }
}
