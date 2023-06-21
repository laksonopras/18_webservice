<?php

use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ImagePartnerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SquareFeedController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CallController;

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
    return dd("ini 18_webservice");
});
Route::get('review', [ReviewController::class, 'index']);
Route::get('transaction', [TransactionController::class, 'index']);
Route::get('call', [CallController::class, 'index']);
