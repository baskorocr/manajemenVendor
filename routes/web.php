<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\riwayatController;
use App\Http\Controllers\userManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('asset-types', AssetTypeController::class);
    Route::resource('parts', PartController::class);
    Route::resource('proses', ProsesController::class);
    Route::resource('pemiliks', PemilikController::class);
    Route::resource('assetsPart', AssetsController::class);
    Route::resource('photos', PhotoController::class);
    Route::resource('riwayat', riwayatController::class);
    Route::resource('user-manajemen', userManagementController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/assets/search', [AssetsController::class, 'search'])->name('assetsPart.search');


// Route::group(['middleware' => ['auth', 'admin']], function () {
//     Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
//     Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
// });