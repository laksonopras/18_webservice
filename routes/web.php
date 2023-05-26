<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ImagePartnerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SquareFeedController;

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
Route::get('banner', [BannerController::class, 'index']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::get('banner', [BannerController::class, 'index']);
Route::get('img_partner', [ImagePartnerController::class, 'index']);
Route::get('square_feed', [SquareFeedController::class, 'index']);
