<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// Auth::routes();
// // handle redirect register to login
// Route::match(['get','post'],'/register',function(){
//     return redirect('/login');
// });


Route::resource('front',  FrontController::class);

// Route middleware
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\profile\ProfileController::class,'index'])->name('profile.index');
    Route::get('/changePassword', [\App\Http\Controllers\profile\ProfileController::class, 'changePassword'])->name('profile.changePassword');

    // Route for admin
    Route::middleware(['auth', 'admin'])->group(function () {
        // Route for news using resource
        Route::resource('news', NewsController::class);
        // Route for Category using Resource
        // tambahin middleware  auth agar hanya bisa diakses oleh admin
        Route::resource('category', CategoryController::class)->except('show');
        // except buat matiin
        // only buat menampilkan
    });
});
