<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::where('status',0)->get();
        $trendingProducts = Product::where('trending',1)->latest()->take(15)->get();
        $newArrivalProducts = Product::latest()->take(5)->get();
        $featuredProducts = Product::where('featured',1)->latest()->take(15)->get();
        return view('frontend.index',compact('sliders','trendingProducts','newArrivalProducts','featuredProducts'));
    }

    public function categories(){

        $categories = Category::where('status',0)->get();
        return view('frontend.collections.category.index',compact('categories'));
    }

    public function category_products($category_slug){
        $category = Category::where('slug',$category_slug)->first();
        if($category){
        return view('frontend.collections.products.index',compact('category'));
        }
        else{
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug){
        $category = Category::where('slug',$category_slug)->first();

        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status',0)->first();

            if($product){
                return view('frontend.collections.products.view',compact('category','product'));
            }else{
                return redirect()->back();
            }
            }
            else{
                return redirect()->back();
            }
    }

    public function thankYou(){
        return view('frontend.thank-you');
    }

    public function newArrival(){
        $newArrivalProducts = Product::latest()->take(5)->get();
        return view('frontend.pages.new_arrival',compact('newArrivalProducts'));

    }

    public function featuredProducts(){
        $featuredProducts = Product::where('featured',1)->latest()->get();
        return view('frontend.pages.featured_products',compact('featuredProducts'));
    }

    public function footer(){
        return view('layouts.frontend.footer');
    }

    public function search(Request $request){
        if($request->search){
            $searchProducts = Product::where('name','like','%'.$request->search.'%')->latest()->paginate(15);
            return view('frontend.pages.search',compact('searchProducts'));
        }else{
            return redirect()->back('message','No records Found');
        }
    }
}
