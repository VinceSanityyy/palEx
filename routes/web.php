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

Auth::routes();
Route::get('/getUsers', [App\Http\Controllers\NewsfeedController::class, 'getUsers']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('{path}',[App\Http\Controllers\HomeController::class, 'index'])->where( 'path', '([A-z]+)?' );
// Route::get('{path}',)->where( 'path', '([A-z]+)?' );
Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');

// Route::get('/vendor/orders', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/vendor/products', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/vendor', [App\Http\Controllers\HomeController::class, 'index']);



// Route::get('/admin/users', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/admin/feeds', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index']);
