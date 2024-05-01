<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request){
        $validated_data = $request->validated();
        
        $category = new Category;
        $category->category_name = $validated_data['category_name'];
        $category->slug = Str::slug($validated_data['slug']);
        $category->description = $validated_data['description'];

        if($request->hasFile('images')){
            $file = $request->file('images');
            $ext = $file->getClientOriginalExtension();
            $filename = time(). "." .$ext;  
            $path = 'uploads/category/';
            $file->move('uploads/category/',$filename);
            $category->images = $path.$filename;
        }
        $category->meta_title = $validated_data['meta_title'];
        $category->meta_keyword = $validated_data['meta_keyword'];
        $category->meta_description = $validated_data['meta_description'];
        $category->status = $request->status == true ? 1 : 0;

        $category->save();

        return redirect('admin/category')->with('message','Category Added Successfully.');
        
    }
    public function edit(Category $category){
      // return $category;
       return view('admin.category.edit',compact('category'));
    }

    public function update(CategoryFormRequest $request, $category){

        $validated_data = $request->validated();
        
        $category = Category::findOrFail($category);
      //  dd($category);
        $category->category_name = $validated_data['category_name'];
        $category->slug = Str::slug($validated_data['slug']);
        $category->description = $validated_data['description'];

        if($request->hasFile('images')){

            $path = $category->images;
            if(File::exists($path)){
                File::delete($path);
            }
            $uploadPath = 'uploads/category/';
            $file = $request->file('images');
            $ext = $file->getClientOriginalExtension();
            $filename = time(). "." .$ext;  

            $file->move('uploads/category/',$filename);
            $category->images =  $uploadPath.$filename;
        }
        $category->meta_title = $validated_data['meta_title'];
        $category->meta_keyword = $validated_data['meta_keyword'];
        $category->meta_description = $validated_data['meta_description'];
        $category->status = $request->status == true ? 1 : 0;

        $category->update();

        return redirect('admin/category')->with('message','Category Updated Successfully.');
    }

   

}
