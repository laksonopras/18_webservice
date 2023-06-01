<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\BannerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'user'], function ($router) {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    // Route::post('refresh', 'AuthController@refresh');
    Route::get('me', [UserController::class, 'show']);
    Route::get('category', [CategoryController::class, 'index']);

    Route::post('editProfile', [UserController::class, 'update']);
    Route::get('avatar/{id}', [UserController::class, 'getAvatar']);
    Route::get('avatar', [UserController::class, 'getUserAvatar']);

    Route::post('mitra', [PartnerController::class, 'store']);
});

Route::group(['middleware' => 'api', 'prefix' => 'admin'], function ($router) {
    Route::post('register', [AdminController::class, 'register']);
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout']);
    Route::get('me', [AdminController::class, 'me']);


    //Customer
    Route::get('customer', [UserController::class, 'index']);
    Route::get('customer/avatar/{id}', [UserController::class, 'getAvatar']);
    Route::get('customer/{id}', [UserController::class, 'show']);
    Route::delete('customer/{id}', [UserController::class, 'destroy']);

    //Category
    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'show']);
    Route::post('category/', [CategoryController::class, 'store']);
    Route::put('category/{id}', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy']);

    //Banner
    Route::get('banner', [BannerController::class, 'index']);
    Route::get('banner/{id}', [BannerController::class, 'show']);
    Route::post('banner/', [BannerController::class, 'store']);
    Route::put('banner/{id}', [BannerController::class, 'update']);
    Route::delete('banner/{id}', [BannerController::class, 'destroy']);


    // Route::post('refresh', 'AuthController@refresh');
    Route::get('/partner', [PartnerController::class, 'index']);
    Route::get('/partner/{id}', [PartnerController::class, 'showDetail']);
    Route::patch('/partner/{id}', [PartnerController::class, 'update']);
    Route::get('/partner/avatar/{id}', [PartnerController::class, 'getAvatar']);
});

Route::delete('/partner/{id}', [PartnerController::class, 'destroy']);


Route::get('category', [CategoryController::class, 'index']);
