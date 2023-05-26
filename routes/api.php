<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
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

Route::group(['middleware' => 'api', 'prefix' => 'user' ], function ($router) {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    // Route::post('refresh', 'AuthController@refresh');
    Route::get('me', [UserController::class, 'show']);
    Route::get('category', [CategoryController::class, 'index']);
});

Route::group(['middleware' => 'api', 'prefix' => 'admin' ], function ($router) {
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

Route::get('/partner/{id}', [PartnerController::class, 'index']);
Route::delete('/partner/{id}', [PartnerController::class, 'destroy']);

