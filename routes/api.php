<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
<<<<<<< HEAD
use App\Http\Controllers\CategoryController;
=======
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
>>>>>>> 387bd9be6ad77b09ea9387ec27230b6f6beccf00
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

Route::group(['middleware' => 'api', 'prefix' => 'customer' ], function ($router) {
    Route::post('register', [CustomerController::class, 'register']);
    Route::post('login', [CustomerController::class, 'login']);
    Route::post('logout', [CustomerController::class, 'logout']);
    // Route::post('refresh', 'AuthController@refresh');
    Route::get('me', [UserController::class, 'show']);
    Route::get('category', [CategoryController::class, 'index']);
});

Route::group(['middleware' => 'api', 'prefix' => 'admin'], function ($router) {
    Route::post('register', [AdminController::class, 'register']);
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout']);
    Route::get('me', [AdminController::class, 'me']);
    
    //Category
    Route::get('category', [CategoryController::class, 'index']);
    Route::post('category/add', [CategoryController::class, 'store']);
    Route::put('category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy']);
    
    
    // Route::post('refresh', 'AuthController@refresh');
});

<<<<<<< HEAD
Route::get('category', [CategoryController::class, 'index']);
=======
Route::get('/partner/{id}', [PartnerController::class, 'index']);
Route::delete('/partner/{id}', [PartnerController::class, 'destroy']);

>>>>>>> 387bd9be6ad77b09ea9387ec27230b6f6beccf00
