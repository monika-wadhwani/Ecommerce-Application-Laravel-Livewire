<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule as ValidationRule;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $name, $slug, $status, $brand_id;

    public function rules(){
        return[
            'name'=> 'required|string',
            'slug'=>'required|string',
            'status'=>'nullable'
        ];
    }

    public function resetInput(){
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }
    public function render()
    {
        $brands = Brand::orderBy('id','Desc')->paginate(5);
        $category = Category::get();
        return view('livewire.admin.brand.index',['brands'=> $brands,'category'=> $category])->extends('layouts.admin')->section('content');
    }
    public function store(){
     
        $validateData = $this->validate();
        Brand::create([
          'name'=>$this->name,
          'slug'=>Str::slug($this->slug),
          'status'=>$this->status === true ? 1 : 0
        ]);

        return redirect('admin/brands')->with('message','Brand Saved Successfully.');
        $this->resetInput();
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function editBrand($brandID){
        
        $this->brand_id = $brandID;
        $brand = Brand::findOrFail($brandID);
        $this->name = $brand->name;
        $this->slug = $brand->slug; 
        $this->status = $brand->status == 1 ? true : false;
    //   dd($this->status);
    }

    public function updateBrand(){
        $validateData = $this->validate();
        Brand::find($this->brand_id)->update([
            'name'=> $this->name,
            'slug' => $this->slug,
            'status' => $this->status === true ? 1 : 0,
        ]);
        return redirect('admin/brands')->with('message','Brand Updated Successfully.');
        $this->resetInput();
    }

    public function destroyBrand($brandID){
        $this->brand_id = $brandID;
    }

    public function deleteBrand(){
        Brand::find($this->brand_id)->delete();
        return redirect('admin/brands')->with('message','Brand Deleted Successfully.');
        $this->resetInput();
    }
    
}
