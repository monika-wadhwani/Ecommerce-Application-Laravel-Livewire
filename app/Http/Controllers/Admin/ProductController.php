<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        //return($products);
        return view('admin.products.index',compact('products'));
    }
    public function create(){
        $categories = Category::get();
        $brands = Brand::get();
        $colors = Color::where('status',0)->get();
        return view('admin.products.create',compact('categories','brands','colors'));
    }
    public function store(ProductFormRequest $request){
        $validated_data = $request->validated();
        $category = Category::findOrFail($validated_data['category_id']);

        $product = $category->products()->create([
            'category_id' => $validated_data['category_id'],
            'name' => $validated_data['name'],
            'slug' => Str::slug($validated_data['slug']),
            'small_description' => $validated_data['small_description'],
            'long_description' => $validated_data['long_description'],
            'original_price' => $validated_data['original_price'],
            'selling_price' => $validated_data['selling_price'],
            'brand' => $validated_data['brand'],
            'quantity' => $validated_data['quantity'],
            'meta_title' => $validated_data['meta_title'],
            'meta_keyword' => $validated_data['meta_keyword'],
            'meta_description' => $validated_data['meta_description'],
            'status' => $request->status == true ? 1 : 0,
            'trending' => $request->trending == true ? 1 : 0,
            'featured' => $request->featured == true ? 1 : 0,
        ]);

       // return $product->id; die;

       if($request->hasFile('images')){

            $uploadImagePath = 'uploads/products/';
            $i=1;
            foreach($request->file('images') as $images){
                $ext = $images->getClientOriginalExtension();
                $filename = time().$i++. "." .$ext;  
                $images->move($uploadImagePath,$filename);
                $finalImagePath = $uploadImagePath.$filename;
                $product->products_images()->create([
                    'product_id' =>  $product->id,
                    'image' => $finalImagePath,
        
                ]);
            }        
        }
      
        if($request->colors){
          foreach($request->colors as $key => $value){
            $product->productColors()->create([
                'product_id' => $product->id,
                'color_id' => $value,
                'quantity' => $request->colorquantity[$key] ?? 0
            ]);
          }  
        }
        return redirect('admin/products')->with('message','Product Added Successfully.');
    }
    public function edit($product_id){
        $product = Product::findOrFail($product_id);
        // return($product->products_images);
        // die;
        $categories = Category::get();
        $brands = Brand::get();
        $productColors = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIN('id',$productColors)->get();
        return view('admin.products.edit',compact('product','categories','brands','productColors','colors'));
    }

    public function update($product_id, ProductFormRequest $request){
        $validated_data = $request->validated();
        $product = Category::findOrFail($validated_data['category_id'])->products()->where('id', $product_id)->first();
        if($product){
                $product->update([
                'category_id' => $validated_data['category_id'],
                'name' => $validated_data['name'],
                'slug' => Str::slug($validated_data['slug']),
                'small_description' => $validated_data['small_description'],
                'long_description' => $validated_data['long_description'],
                'original_price' => $validated_data['original_price'],
                'selling_price' => $validated_data['selling_price'],
                'brand' => $validated_data['brand'],
                'quantity' => $validated_data['quantity'],
                'meta_title' => $validated_data['meta_title'],
                'meta_keyword' => $validated_data['meta_keyword'],
                'meta_description' => $validated_data['meta_description'],
                'status' => $request->status == true ? 1 : 0,
                'trending' => $request->trending == true ? 1 : 0,
                'featured' => $request->featured == true ? 1 : 0,
            ]);

            if($request->hasFile('images')){

                $uploadImagePath = 'uploads/products/';
                $i=1;
                foreach($request->file('images') as $images){
                    $ext = $images->getClientOriginalExtension();
                    $filename = time().$i++. "." .$ext;  
                    $images->move($uploadImagePath,$filename);
                    $finalImagePath = $uploadImagePath.$filename;
                    $product->products_images()->create([
                        'product_id' =>  $product->id,
                        'image' => $finalImagePath,
            
                    ]);
                }        
            }
            if($request->colors){
                foreach($request->colors as $key => $color){
                    $product->productColors()->create([
                        'product_id' =>$product->id,
                        'color_id' => $color,
                        'quantity' => $request->colorquantity[$key] ?? 0
                        
                    ]);
                }
            }
            
            return redirect('admin/products')->with('message','Product Updated Successfully.');

        }else{

            return redirect('admin/products')->with('message','No Product Found');
        }
     

    }

    public function delete_image($image_id){
       $imageData = ProductImage::findOrFail($image_id);

       if(File::exists($imageData->image)){
        File::delete($imageData->image);
       }
        $imageData->delete();

        return redirect()->back()->with('message','Product Image Deleted Successfully');

    }
    public function delete($product_id){
        $product = Product::findOrFail($product_id);
        if($product->products_images){
            foreach($product->products_images as $images){
                if(File::exists($images->image)){
                    File::delete($images->image);
                }
               $images->delete(); 
            }
        }
        $product->delete();

        return redirect('admin/products')->with('message','Product Data Deleted Successfully');

    }
    public function updateProductColorQty($product_color_id, Request $request){
        $productColorData = Product::findOrFail($request->product_id)->productColors()->where('id',$product_color_id)->first();
        
        // return($productColorData); die;

        $productColorData->update([
            'quantity'=>$request->quantity
        ]);

        return response()->json(['message'=>'Product Quantity Updated Successfully.']);
       
    }

    public function deleteProductColor($product_color_id){
        $productColorData = ProductColor::findOrFail($product_color_id);
        $productColorData->delete();

        return response()->json(['message'=>'Product Color Deleted Successfully.']);
    }
}
