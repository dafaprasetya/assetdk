<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\ITController;
use App\Http\Controllers\STController;
use App\Http\Controllers\Api\LoginAPI;
use App\Http\Controllers\Api\AssetAPI;
use App\Http\Controllers\Api\BarcodeAPI;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return redirect()->route('login');
});

// Route assets/barang
Route::middleware(['auth', 'asset'])->group(function () {
    Route::get('/asset',[AssetController::class, 'index'])->name('listasset');
    Route::get('/asset/laporan',[AssetController::class, 'buatlaporanasset'])->name('buatlaporan');
    Route::get('/asset/laporan/dkl',[AssetController::class, 'buatlaporanassetlancar'])->name('buatlaporandkl');
    Route::get('/asset/dkl',[AssetController::class, 'indexdkl'])->name('listassetdkl');
    Route::get('/asset/tambah/asset',[AssetController::class, 'tambahbarang'])->name('tambahasset');
    Route::get('/asset/edit/{dkasset}',[AssetController::class, 'edit'])->name('editasset');
    Route::post('/asset/edit/{dkasset}/p',[AssetController::class, 'editpost'])->name('editassetpost');
    Route::post('/asset/d/{dkasset}',[AssetController::class, 'hapus'])->name('hapusasset');
    Route::post('/asset/tambah/asset/upload',[AssetController::class, 'tambahbarangpost'])->name('tambahassetpost');
    Route::get('/asset/cetak/all',[AssetController::class, 'cetaksemua'])->name('cetak');
    Route::get('/asset/cetak/dkl',[AssetController::class, 'cetakdkl'])->name('cetakdkl');
    Route::get('/asset/serahterima',[STController::class, 'index'])->name('serahterima');
    Route::get('/asset/serahterima/buat',[STController::class, 'buatserahterima'])->name('buatserahterima');
    Route::post('/asset/serahterima/create',[STController::class, 'create'])->name('createserahterima');
    Route::post('/asset/serahterima/delete/{id}',[STController::class, 'delete'])->name('deleteserahterima');
    Route::get('/asset/serahterima/edit/{id}',[STController::class, 'edit'])->name('editserahterima');
    Route::post('/asset/serahterima/edit/go/{id}',[STController::class, 'editpost'])->name('editpostserahterima');
    Route::post('/asset/update/harga/{id}',[AssetController::class, 'hitungPenyusutan'])->name('updateharga');
});
Route::middleware(['auth','IT'])->group(function () {
    // USER
    Route::get('/IT/user',[ITController::class, 'userlist'])->name('userlist');
    Route::post('/IT/user/edit/{nik}',[ITController::class, 'edituser'])->name('edituser');
    Route::post('/IT/user/hapus/{nik}',[ITController::class, 'deleteuser'])->name('hapususer');
    // KATEGORI
    Route::get('/IT/kategori',[ITController::class, 'kategorilist'])->name('kategorilist');
    Route::post('/IT/kategori/hapus/{id}',[ITController::class, 'deletekategori'])->name('hapuskategori');
    Route::post('/IT/kategori/edit/{id}',[ITController::class, 'editkategori'])->name('editkategori');
    Route::post('/IT/kategori/buat',[ITController::class, 'buatkategori'])->name('buatkategori');
    // JABATAN
    Route::get('/IT/jabatan',[ITController::class, 'jabatanlist'])->name('jabatanlist');
    Route::post('/IT/jabatan/hapus/{id}',[ITController::class, 'deletejabatan'])->name('hapusjabatan');
    Route::post('/IT/jabatan/edit/{id}',[ITController::class, 'editjabatan'])->name('editjabatan');
    Route::post('/IT/jabatan/buat',[ITController::class, 'buatjabatan'])->name('buatjabatan');
    // DIVISI
    Route::get('/IT/divisi',[ITController::class, 'divisilist'])->name('divisilist');
    Route::post('/IT/divisi/hapus/{id}',[ITController::class, 'deletedivisi'])->name('hapusdivisi');
    Route::post('/IT/divisi/edit/{id}',[ITController::class, 'editdivisi'])->name('editdivisi');
    Route::post('/IT/divisi/buat',[ITController::class, 'buatdivisi'])->name('buatdivisi');
});
Route::get('/asset/{dkasset}',[AssetController::class, 'show'])->name('detailasset');
Route::get('/asset/serahterima/show/{id}',[STController::class, 'show'])->name('showserahterima');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard/dkl', [App\Http\Controllers\HomeController::class, 'indexdkl'])->name('homedkl');



// API HANDLE

Route::post('/api/login', [LoginAPI::class, '__invoke'])->name('loginAPI');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/api/asset/{dkasset}', [AssetAPI::class, 'showAsset'])->name('showassetapi');
Route::get('/api/asset/barcode/{dkasset}', [BarcodeAPI::class, 'getBarcode'])->name('getBarcodeAPI');
Route::middleware('auth:api')->group(function () {
    Route::get('/api/getassetkondisi', [AssetAPI::class, 'getKondisi'])->name('getKondisiAssetAPI');
    Route::get('/api/getassetkondisidkl', [AssetAPI::class, 'getKondisiDKL'])->name('getKondisiAssetDKLAPI');
    Route::get('/api/getallasset', [AssetAPI::class, 'getAllAsset'])->name('getAllAsset');
    Route::get('/api/getallassetdkl', [AssetAPI::class, 'getAllAssetDKL'])->name('getAllAssetDKL');
    Route::post('/api/insert/asset', [AssetAPI::class, 'insertAsset'])->name('insertassetAPI');
    Route::post('/api/edit/asset/{asset}', [AssetAPI::class, 'editAsset'])->name('editassetAPI');
});