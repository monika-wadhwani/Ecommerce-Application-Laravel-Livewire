<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('admin.sliders.index',compact('sliders'));
    }

    public function create(){

        return view('admin.sliders.create');
    }

    public function store(SliderFormRequest $request){
        $validatedData = $request->validated();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $path = 'uploads/sliders/';
            $filename = time().".".$ext;
            $file->move($path,$filename);
            $validatedData['image'] = $path.$filename;
        }
        Slider::create([
            'title'=> $validatedData['title'],
            'description'=> $validatedData['description'],
            'image'=> $validatedData['image'] ?? 0,
            'status'=> $request->status == true ? 1 : 0 
        ]);

        return redirect('admin/sliders')->with('message','Slider Added Successfully');

    }

    public function edit(Slider $slider){

        return view('admin.sliders.edit',compact('slider'));
    }

    public function update(Slider $slider, SliderFormRequest $request){
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            if(File::exists($slider->image)){

                File::delete($slider->image);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $path = 'uploads/sliders/';
            $filename = time().".".$ext;
            $file->move($path,$filename);
            $validatedData['image'] = $path.$filename;
        }
        Slider::where('id',$slider->id)->update([
            'title'=> $validatedData['title'],
            'description'=> $validatedData['description'],
            'image'=> $validatedData['image'] ?? $slider->image,
            'status'=> $request->status == true ? 1 : 0 
        ]);

        return redirect('admin/sliders')->with('message','Slider Updated Successfully');
    }

    public function delete(Slider $slider){

        if($slider->count() > 0){
            if(File::exists($slider->image)){
                File::delete($slider->image);
            }
            $slider->delete();
    
            return redirect('admin/sliders')->with('message','Slider Deleted Successfully');
        }
       
            return redirect('admin/sliders')->with('message','Something Went Wrong');
       
       
    }

}
