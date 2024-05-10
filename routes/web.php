<?php

use App\Livewire\Section;
use App\Livewire\Admin\Brand\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class,'index']);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class,'categories']);
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class,'category_products']);
Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class,'productView']);
Route::get('new_arrivals',[App\Http\Controllers\Frontend\FrontendController::class,'newArrival']);
Route::get('featured_products',[App\Http\Controllers\Frontend\FrontendController::class,'featuredProducts']);
Route::get('footer',[App\Http\Controllers\Frontend\FrontendController::class,'footer']);
Route::get('search',[App\Http\Controllers\Frontend\FrontendController::class,'search']);

Route::middleware('auth')->group(function (){
    Route::get('wishlist',[App\Http\Controllers\Frontend\WishlistController::class,'index']);
    Route::get('cart', [App\Http\Controllers\Frontend\CartListController::class,'index']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class,'index']);
    Route::get('myOrders', [App\Http\Controllers\Frontend\OrderController::class,'myOrders']);
    Route::get('orders/{order_id}', [App\Http\Controllers\Frontend\OrderController::class,'viewOrders']);
    Route::get('profile',[App\Http\Controllers\Frontend\ProfileController::class,'profile']);
    Route::post('profile',[App\Http\Controllers\Frontend\ProfileController::class,'updateProfile']);
    Route::get('change_password',[App\Http\Controllers\Frontend\ProfileController::class,'change_password']);
    Route::post('change_password',[App\Http\Controllers\Frontend\ProfileController::class,'confirmed_password']);
});

Route::get('thank-you',[App\Http\Controllers\Frontend\FrontendController::class,'thankYou']);

Route::view('/livewire','livewire');
Route::view('/registration','registration');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/todo', [App\Http\Controllers\HomeController::class, 'todoApp'])->name('todo');


Route::get('/section',[App\Livewire\Section::class, 'render'])->name('section');

Auth::routes();
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
   
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('save', 'store');
        Route::get('category/edit/{category}', 'edit');
        Route::put('update/{category}', 'update');
    });

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('products', 'index');
        Route::get('products/create', 'create');
        Route::post('store', 'store');
        Route::get('/products/edit/{product}', 'edit');
        Route::get('/products/delete/{product}', 'delete');
        Route::put('products/update/{product}', 'update');
        Route::get('product-image/delete/{image_id}', 'delete_image');
        Route::post('update/{product_color_id}', 'updateProductColorQty');
        Route::get('product-color/delete/{product_color_id}', 'deleteProductColor');
    });
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);
   
    Route::get('brands', App\Livewire\Admin\Brand\Index::class);

    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('colors', 'index');
         Route::get('colors/create', 'create');
         Route::post('colors/store', 'store');
        Route::get('/colors/edit/{color}', 'edit');
        Route::get('/colors/delete/{color}', 'delete');
    });

    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('sliders', 'index');
        Route::get('sliders/create', 'create');
        Route::post('sliders/store', 'store');
        Route::get('/sliders/edit/{slider}', 'edit');
        Route::put('/sliders/update/{slider}', 'update');
        Route::get('/sliders/delete/{slider}', 'delete');
    });

    
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('orders', 'allOrders');
        Route::get('show_orders/{order_id}','viewOrders');
        Route::put('show_orders/{order_id}','updateOrder');
        Route::get('view_invoice/{order_id}','viewInvoice');
        Route::get('generate_invoice/{order_id}','generateInvoice');
        Route::get('mail_invoice/{order_id}','generateMailInvoice');
    });

     Route::get('settings',[App\Http\Controllers\Admin\SettingController::class,'index']);
     Route::post('save_setting',[App\Http\Controllers\Admin\SettingController::class,'save_setting']);

     Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('users', 'index');
        Route::get('users/create', 'create');
        Route::post('users/store', 'store');
        Route::get('users/edit/{user}', 'edit');
        Route::put('users/update/{user}', 'update');
        Route::get('users/delete/{user}', 'delete');
    });
});


