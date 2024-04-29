<?php

namespace App\Livewire\Admin\Category;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use withPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;

    public function render()
    {
        $categories = Category::orderBy('id','desc')->paginate(5);
        return view('livewire.admin.category.index',['categories'=> $categories]);
    }

    public function destroyCategory($category_id){
        $this->category_id = $category_id;
    }
    
    public function deleteCategory(){    
        $category_info = Category::findOrFail($this->category_id);
        $path_info = 'uploads/category/'.$category_info->images;
        if(File::exists($path_info)){
            File::delete($path_info);
        }
        $category_info->delete();
        return redirect('admin/category')->with('message','Category Deleted Successfully.');
    }
}
