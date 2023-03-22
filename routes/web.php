<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductInfoController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 * Admin Routes
 */
Route::prefix('admin')->group(function() {

    Route::middleware('auth:admin')->group(function() {
        // Dashboard
       // Route::get('/', 'DashboardController@index');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Products
        Route::resource('/products', 'App\Http\Controllers\ProductController');
       // Route::resource('/productinfo/{id}', 'App\Http\Controllers\ProductInfoController');
        //Route::resource('/products','ProductController');

        // Orders
        Route::resource('/orders','App\Http\Controllers\OrderController');
        Route::get('/confirm/{id}','OrderController@confirm')->name('order.confirm');
        Route::get('/pending/{id}','OrderController@pending')->name('order.pending');

        // Users
        Route::resource('/users','App\Http\Controllers\UsersController');

        // Logout
        Route::get('/logout', [AdminUserController::class, 'logout']);
       // Route::get('/logout','AdminUserController@logout');

       Route::resource('/categories', 'App\Http\Controllers\CategoryController');
       Route::resource('/subcategories', 'App\Http\Controllers\SubCategoryController');
       Route::DELETE('/product-image-gallery/{id}', [ProductController::class, 'productImageDelete'])->name('product.image.gallery');
       Route::get('/products-lists', [ProductController::class, 'getProducts'])->name('products.list');

       //Product Info
       Route::get('/productinfo/{id}', [ProductInfoController::class, 'index'])->name('productinfo.index');
       Route::get('/productinfo-list/{id}', [ProductInfoController::class, 'getProductsInfo'])->name('productinfo.list');
       Route::get('/productinfo/{id}/create', [ProductInfoController::class, 'create'])->name('productinfo.create');
       Route::post('/productinfo/{id}/create', [ProductInfoController::class, 'store'])->name('productinfo.create');
       Route::get('/productinfo/{id}/edit/{productid}', [ProductInfoController::class, 'edit'])->name('productinfo.edit');
       Route::post('/productinfo/{id}/update/{productid}', [ProductInfoController::class, 'update'])->name('productinfo.update');
       Route::delete('/productinfo/{id}', [ProductInfoController::class, 'destroy'])->name('productinfo.delete');


       Route::post('/subcat', [SubCategoryController::class, 'subCat']);

    });

    // Admin Login
    Route::get('/login', [AdminUserController::class, 'index'])->name('login');
    Route::post('/login', [AdminUserController::class, 'store']);

  //  Route::get('/login', 'AdminUserController@index')->name('login');
    //Route::post('/login', 'AdminUserController@store');
    
   
    
  //  Route::DELETE('/product-image-gallery/{id}','ProductController@confirm')->name('product.image.gallery');
   // Route::delete('/products.destroy/{id}', [ProductController::class, 'destroy']);
   
   
});
Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/', function () {
    return view('index');
});
Route::get('/about-us', function () {
    return view('about-us');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/checkout', function () {
    return view('checkout');
});
Route::get('/contact-us', function () {
    return view('contact-us');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});
Route::get('/product-detail', function () {
    return view('product-detail');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/return-policy', function () {
    return view('return-policy');
});
Route::get('/shop', function () {
    return view('shop');
});
Route::get('/terms-condition', function () {
    return view('terms-condition');
});
Route::get('/thank-you', function () {
    return view('thank-you');
});
Route::get('/terms-conditions', function () {
    return view('terms-conditions');
});







