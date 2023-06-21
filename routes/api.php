<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\GetPictController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SquareFeedController;
use App\Http\Controllers\TransactionController;
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
    Route::post('register', [AdminController::class, 'register']); //Registrasi Admin
    Route::post('login', [AdminController::class, 'login']); //Login Admin

    Route::group(['middleware' => 'auth-admin'], function ($router) {
        Route::post('logout', [AdminController::class, 'logout']); //logout admin

        //My Profile
        Route::get('me', [AdminController::class, 'getByToken']);  //menampilkan informasi admin yang login
        Route::post('update', [AdminController::class, 'update']); //memperbarui data admin yang login

        //Category
        Route::get('category', [CategoryController::class, 'index']); //menampilkan semua kategori
        Route::get('category/{id}', [CategoryController::class, 'show']); //menampilkan 1 kategori
        Route::post('category/', [CategoryController::class, 'store']); //membuat kategori baru
        Route::put('category/{id}', [CategoryController::class, 'update']); //memperbarui kategori yang sudah ada
        Route::delete('category/{id}', [CategoryController::class, 'destroy']); //menghapus kategori

        //Banner
        Route::get('banner', [BannerController::class, 'index']); // menampilkan semua banner
        Route::post('banner/', [BannerController::class, 'store']); //menambahkan 1 banner
        Route::post('banner/{id}', [BannerController::class, 'update']); //memperbarui banner yang sudah ada
        Route::delete('banner/{id}', [BannerController::class, 'destroy']); //menghapus banner
        
        //Square Feed
        Route::get('sq', [SquareFeedController::class, 'index']); // menampilkan semua sq
        Route::get('sq/{id}', [GetPictController::class, 'getSquareFeed']); //menampilkan 1 sq
        Route::post('sq/', [SquareFeedController::class, 'store']); //menambahkan 1 sq
        Route::post('sq/{id}', [SquareFeedController::class, 'update']); //memperbarui sq yang sudah ada
        Route::delete('sq/{id}', [SquareFeedController::class, 'destroy']); //menghapus banner
        
        //Customer
        Route::get('user', [UserController::class, 'index']); //menapmilkan semua customer
        Route::get('user/{id}', [UserController::class, 'getById']); //menampilkan 1 customer
        Route::post('user/{id}', [UserController::class, 'updateForAdmin']); //update customer dari admin
        Route::delete('user/{id}', [UserController::class, 'destroy']); //menghapus customer
        
        //partner
        Route::get('/transaction', [TransactionController::class, 'index']); //menampilkan semua transaksi
        Route::put('/transaction/{id}', [TransactionController::class, 'update']); //update semua transaksi
        
        //partner
        Route::get('/partner', [PartnerController::class, 'index']); //menampilkan semua partner
        Route::get('/partner/{id}', [PartnerController::class, 'showDetail']); //menampilkan 1 partner
        Route::get('/partner/active', [PartnerController::class, 'getActivePartner']); //menampilkan partner yang sudah aktivasi
        Route::get('/partner/unactive', [PartnerController::class, 'getUnactivePartner']); //menampilkan partner yang belum aktivasi
        Route::get('/partner/open', [PartnerController::class, 'getOpenPartner']); //menampilkan partner yang sudah buka
        Route::post('/partner/update/{id}', [PartnerController::class, 'updateForAdmin']); //memperbarui data partner
        Route::put('/partner/{id}/confirmation', [PartnerController::class, 'confirmation']); //shortcut confirmasi data partner
        Route::post('/partner/{id}', [PartnerController::class, 'destroy']); //menghapus data partner

        //package
        Route::get('/package', [PackageController::class, 'index']);
        Route::get('package/{id}', [PackageController::class, 'show']); //menampilkan 1 package
        Route::post('package/', [PackageController::class, 'store']); //membuat package baru
        Route::put('package/{id}', [PackageController::class, 'update']); //memperbarui package yang sudah ada
        Route::delete('package/{id}', [PackageController::class, 'destroy']); //menghapus package
    });
    Route::get('banner/{id}', [GetPictController::class, 'getBanner']); //menampilkan 1 banner
    Route::get('avatar', [GetPictController::class, 'getAdminbyToken']); //menampilkan foto profil admin yang login
    Route::get('user/avatar/{id}', [GetPictController::class, 'getUserbyId']); //menampilkan foto profil customer
    Route::get('/partner/avatar/{id}', [GetPictController::class, 'getPartner']); //menampilkan foto profil partner
    Route::get('/payment_proof/{id}', [GetPictController::class, 'getPaymentProof']);
});

Route::group(['middleware' => 'api', 'prefix' => 'user'], function ($router) {


    //authentication
    Route::post('register', [UserController::class, 'register']); //Registrasi customer
    Route::post('login', [UserController::class, 'login']); //Login customer

    Route::group(['middleware' => 'auth-user'], function ($router) {
        Route::post('logout', [UserController::class, 'logout']); //logout customer

        //My Profile
        Route::get('me', [UserController::class, 'getByToken']); //menampilkan profile customer yang sedang login
        Route::post('update', [UserController::class, 'update']); // memperbarui data aprtner yang sedang 

        //category
        Route::get('category', [CategoryController::class, 'index']); //menampilkan semua kategori

        // banner
        Route::get('banner', [BannerController::class, 'index']); // menampilkan semua banner
        
        //partner
        Route::get('/partner/active', [PartnerController::class, 'getActivePartner']); //menampilkan daftar partner yang aktif
        Route::get('/partner/open', [PartnerController::class, 'getOpenPartner']); //menampilkan daftar partner yang buka
        Route::post('/partner/update', [PartnerController::class, 'updateForUser']); //memperbarui informasi partner
        Route::get('/partner/you', [PartnerController::class, 'show']); //menampilkan mitranya sendiri
        Route::get('/partner/{id}', [PartnerController::class, 'showDetail']); //menampilkan mitranya sendiri
        Route::post('/partner', [PartnerController::class, 'store']); //menampilkan mitranya sendiri
        
        //call
        Route::post('/call/{id}', [CallController::class, 'store']); //membuat panggilan
        Route::get('/call/final', [CallController::class, 'historyUser']); //Histori panggilan pengguna
        Route::get('/call/process', [CallController::class, 'processing']); //Histori panggilan pengguna
        Route::get('/call/partner/{id}', [CallController::class, 'historyPartner']); //histori panggilan partner
        Route::post('/call/update/{id}', [CallController::class, 'update']); //histori panggilan partner
        
        Route::get('progres', [ProgresController::class, 'index']); //Registrasi customer
        
        //transaction
        Route::post('/partner/transaction/{id}', [TransactionController::class, 'update']); //Registrasi customer
        Route::post('/partner/transaction/', [TransactionController::class, 'store']); //Registrasi customer
        Route::get('/partner/transaction/list', [TransactionController::class, 'forMitra']); //Registrasi customer
        
        //Package
        Route::get('/package', [PackageController::class, 'index']);
        
        
    });
    Route::get('banner/{id}', [GetPictController::class, 'getBanner']); //menampilkan 1 banner
    Route::get('avatar', [GetPictController::class, 'getUserbyToken']); //menampilkan gambar partner yang sedang login
    Route::get('/payment_proof/{id}', [GetPictController::class, 'getPaymentProof']); //menampilkan gambar partner yang sedang login
    Route::get('/partner/avatar/{id}', [GetPictController::class, 'getPartner']); //menampilkan logo partner
    Route::get('/mitra/avatar', [GetPictController::class, 'getMyPartner']); //menampilkan logo partner
});

//location
Route::get('/provinsi', [RegionController::class, 'getProvince']);
Route::get('/kota/{id}', [RegionController::class, 'getCity']);
Route::get('/kecamatan/{id}', [RegionController::class, 'getDistrict']);
Route::get('/kelurahan/{id}', [RegionController::class, 'getVillage']);
Route::get('/kelurahan', [RegionController::class, 'getVillages']);
Route::get('/kodepos{id}', [RegionController::class, 'getPostcode']);

