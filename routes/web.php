<?php

use App\Http\Controllers\AssetController;
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

// Route assets/barang
Route::middleware(['auth'])->group(function () {
    Route::get('/asset',[AssetController::class, 'index'])->name('listasset');
    Route::get('/asset/tambah/asset',[AssetController::class, 'tambahbarang'])->name('tambahasset');
    Route::post('/asset/tambah/asset/upload',[AssetController::class, 'tambahbarangpost'])->name('tambahassetpost');
    Route::get('/asset/serahterima',[AssetController::class, 'serahterima'])->name('buatserahterima');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
