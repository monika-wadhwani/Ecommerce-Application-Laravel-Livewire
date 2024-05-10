<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $orders = Order::count();
        $totalProducts = Product::count();
        $totalCategory = Category::count();
        $totalBrands = Brand::count();
        $allUsers = User::count();
        $totalUser = User::where('role_as',0)->count();
        $totalAdmin = User::where('role_as',1)->count();
        $todayOrder = Order::whereDate('created_at',Carbon::now()->format('d-m-Y'))->count();
        $monthOrder = Order::whereMonth('created_at',Carbon::now()->format('m'))->count();
        $yearOrder = Order::whereYear('created_at',Carbon::now()->format('Y'))->count();
        return view('admin.dashboard',compact('orders','totalProducts','totalCategory','totalBrands','allUsers','totalUser','totalAdmin','todayOrder','monthOrder','yearOrder'));
    }

    
}
