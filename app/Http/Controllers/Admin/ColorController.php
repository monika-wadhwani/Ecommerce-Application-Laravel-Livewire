<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
   public function index(){
    $colors = Color::all();
    return view('admin.colors.index',compact('colors'));
   }

   public function create(){
  
    return view('admin.colors.create');
   }

   public function store(ColorFormRequest $request){
    $validatedData = $request->validated();
    Color::create([
        'name' => $validatedData['name'],
        'code' => $validatedData['code'],
        'status' => $request->status == true ? 1 : 0,
    ]);

    return redirect('admin/colors')->with('message','Color Added Successfully.');
   }
   
   public function edit(Color $color){
  
    return view('admin/colors/edit',compact('color'));
   }

   public function update($color, ColorFormRequest $request){
    $validatedData = $request->validated();
    $validatedData['status'] = $request->status == true ? 1 : 0;
    Color::findOrFail($color)->update($validatedData);

    return redirect('admin/colors')->with('message','Color Updated Successfully.');

   }

   public function delete(Color $color){
    $color->delete();
    return redirect('admin/colors')->with('message','Color Deleted Successfully.');
   }

}
