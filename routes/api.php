<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\GetPictController;
use App\Http\Controllers\SquareFeedController;
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

Route::group(['middleware' => 'api', 'prefix' => 'admin'], function ($router) {
    //Authentication
    Route::post('register', [AdminController::class, 'register']); //verified
    Route::post('login', [AdminController::class, 'login']); //verified
    Route::post('logout', [AdminController::class, 'logout']); //verified

    //My Profile
    Route::get('me', [AdminController::class, 'getByToken']); //verified
    Route::get('avatar', [GetPictController::class, 'getAdminbyToken']); //verified
    Route::post('update', [AdminController::class, 'update']); //verified

    //Category
    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'show']);
    Route::post('category/', [CategoryController::class, 'store']);
    Route::put('category/{id}', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy']);

    //Banner
    Route::get('banner', [BannerController::class, 'index']);
    Route::get('banner/{id}', [GetPictController::class, 'getBanner']);
    Route::post('banner/', [BannerController::class, 'store']);
    Route::post('banner/{id}', [BannerController::class, 'update']);
    Route::delete('banner/{id}', [BannerController::class, 'destroy']);

    //Banner
    Route::get('sq', [SquareFeedController::class, 'index']);
    Route::get('sq/{id}', [GetPictController::class, 'getSquareFeed']);
    Route::post('sq/', [SquareFeedController::class, 'store']);
    Route::post('sq/{id}', [SquareFeedController::class, 'update']);
    Route::delete('sq/{id}', [SquareFeedController::class, 'destroy']);

    //Customer
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/avatar/{id}', [GetPictController::class, 'getUserbyId']);
    Route::get('user/{id}', [UserController::class, 'getById']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    //partner
    Route::get('/partner', [PartnerController::class, 'index']);
    Route::get('/partner/{id}', [PartnerController::class, 'showDetail']);
    Route::get('/partner/active', [PartnerController::class, 'getActivePartner']);
    Route::get('/partner/unactive', [PartnerController::class, 'getUnactivePartner']);
    Route::get('/partner/open', [PartnerController::class, 'getOpenPartner']);
    Route::put('/partner/{id}', [PartnerController::class, 'updateForAdmin']);
    Route::get('/partner/avatar/{id}', [GetPictController::class, 'getPartner']);
});



Route::group(['middleware' => 'api', 'prefix' => 'user'], function ($router) {
    //authentication
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);

    //My Profile
    Route::get('me', [UserController::class, 'show']);
    Route::get('avatar', [GetPictController::class, 'getUserbyToken']);
    Route::post('update', [UserController::class, 'update']);

    //category
    Route::get('category', [CategoryController::class, 'index']);

    //partner
    Route::get('/partner/active', [PartnerController::class, 'getActivePartner']); //menampilkan daftar partner yang aktif
    Route::get('/partner/open', [PartnerController::class, 'getOpenPartner']); //menampilkan daftar partner yang buka
    Route::put('/partner',      [PartnerController::class, 'updateForUser']); //memperbarui informasi partner
    Route::get('/partner/avatar/{id}', [GetPictController::class, 'getPartner']); //menampilkan logo partner
    Route::get('/partner/you', [GetPictController::class, 'show']); //menampilkan mitranya sendiri

    //call
    Route::post('/call', [CallController::class, 'store']); //membuat panggilan
    Route::get('/call', [CallController::class, 'historyUser']); //Histori panggilan pengguna
    Route::get('/call/{id}', [CallController::class, 'historyUser']); //histori panggilan partner
    Route::put('/call/{id}', [CallController::class, 'update']); //histori panggilan partner
});
