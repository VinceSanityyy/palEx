<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});
//me
Route::get('/me',[App\Http\Controllers\HomeController::class, 'getAuthenticateduser']);
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('{path}',[App\Http\Controllers\HomeController::class, 'index'])->where( 'path', '([A-z]+)?' );
// Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');


Route::get('/', [App\Http\Controllers\FrontsideController::class, 'index']);
Route::get('/products', [App\Http\Controllers\FrontsideController::class, 'index']);

Route::middleware('isAuth')->group(function(){

    Route::middleware('isVendor')->group(function(){
        Route::get('/vendor/orders', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/vendor/products', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/vendor', [App\Http\Controllers\BacksideController::class, 'index']);

        Route::post('/vendor/createProduct',[App\Http\Controllers\ProductController::class, 'addProduct']);
        Route::get('/vendor/getProducts', [App\Http\Controllers\ProductController::class, 'getProductsPerVendor']);
    });

    Route::middleware('isAdmin')->group(function(){
        Route::get('/admin/users', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/admin/feeds', [App\Http\Controllers\BacksideController::class, 'index']);
        Route::get('/admin', [App\Http\Controllers\BacksideController::class, 'index']);

        //API
        Route::get('/getUsers',[App\Http\Controllers\NewsfeedController::class, 'getUsers']);
        Route::post('/approveUser',[App\Http\Controllers\NewsfeedController::class,'approveUser']);
        Route::get('/countVendors',[App\Http\Controllers\HomeController::class, 'countVendors']);
        Route::get('/countCustomers',[App\Http\Controllers\HomeController::class, 'countCustomers']);
        Route::get('/countAcceptedVendors',[App\Http\Controllers\HomeController::class, 'countAcceptedVendors']);
        //Feeds
        Route::post('/addFeed',[App\Http\Controllers\NewsfeedController::class, 'createFeeds']);
        Route::get('/getFeeds',[App\Http\Controllers\NewsfeedController::class, 'getFeeds']);
    });

    Route::middleware('isCustomer')->group(function(){
        Route::get('/customer', [App\Http\Controllers\FrontsideController::class, 'index']);
        Route::get('/customer/profile', [App\Http\Controllers\FrontsideController::class, 'index']);
        Route::get('/customer/feeds', [App\Http\Controllers\FrontsideController::class, 'index']);
    });
});


// Route::get('/productscopy', [App\Http\Controllers\HomeController::class, 'customerIndex']);
