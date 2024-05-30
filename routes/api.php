<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
    // update password
    Route::post('/updatePassword', [\App\Http\Controllers\API\AuthController::class, 'updatePassword']);
    // store profile
    Route::post('/storeProfile', [AuthController::class, 'storeProfile']);
    // update profile
    Route::post('/updateProfile',[AuthController::class, 'updateProfile']);
});

// Route admin
Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    // Route for category
    Route::post('/category/create', [\App\Http\Controllers\API\CategoryController::class, 'store']);
    Route::post('/category/update/{id}', [\App\Http\Controllers\API\CategoryController::class, 'update']);
    Route::delete('/category/destroy/{id}', [\App\Http\Controllers\API\CategoryController::class, 'destroy']);

    // Route for news
    Route::post('/news/create', [App\Http\Controllers\API\NewsController::class, 'store']);
    Route::delete('/news/destroy/{id}', [App\Http\Controllers\API\NewsController::class, 'destroy']);
    Route::post('/news/update/{id}', [App\Http\Controllers\API\NewsController::class, 'update']);
});


Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::get('/allUsers', [\App\Http\Controllers\API\AuthController::class, 'allUsers']);
// get data news
Route::get('/allNews', [\App\Http\Controllers\API\NewsController::class, 'index']);
// get data news by id
Route::get('/news/{id}', [\App\Http\Controllers\API\NewsController::class, 'show']);
// get data category
Route::get('/category', [\App\Http\Controllers\API\CategoryController::class, 'index']);
// get data category by id
Route::get('/category/{id}', [\App\Http\Controllers\API\CategoryController::class, 'show']);
// get data carrousel
Route::get('/carrousel', [\App\Http\Controllers\API\FrontEndController::class, 'index']);
