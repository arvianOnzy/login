<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PinjamController;
use App\Http\Controllers\DataPinjamanController;
use App\Http\Controllers\DokMasterController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\FIlterController;

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

// Route::get('/', function () {
//     return view('form');
// });
Route::controller(PinjamController::class)->group(function () {
    Route::get('/', 'read')->name('Form Pinjam');
    Route::post('/pinjam-dokumen/store', 'store');
});

Route::middleware('auth')->group(function () {
    Route::controller(DokMasterController::class)->group(function () {
        Route::get('/dashboard', 'read')->name('dashboard');
        Route::get('/lihat-data', 'lihat')->name('Lihat Data');
        Route::get('/tambah-data', 'create')->name('Tambahkan Data');
        Route::post('/tambah-data/store', 'store');
        Route::get('/edit-data/{id}', 'edit')->name('Edit Data');
        Route::put('/update-data/{id}', 'update');
        Route::delete('/hapus-data/{id}', 'delete');
    });
    Route::controller(FolderController::class)->group(function () {
        Route::get('/folder', 'read')->name('Folder');
        Route::get('/tambah-folder', 'create')->name('Tambah Folder');
        Route::get('/tambah-folder/store', 'store');
        Route::get('/edit-folder/{id}', 'edit')->name('Edit Folder');
        Route::get('/update-folder/{id}', 'update');
        Route::get('/hapus-folder/{id}', 'edit')->name('Edit Folder');
    });
    Route::controller(JenisDokumenController::class)->group(function () {
        Route::get('/jenis-dokumen', 'read')->name('Jenis Dokumen');
        Route::get('/tambah-jenis', 'create')->name('Tambah Jenis Dokumen');
        Route::post('/tambah-jenis/store', 'store');
        Route::get('/edit-jenis/{id}', 'edit')->name('Edit Jenis Dokumen');
        Route::put('/update-jenis/{id}', 'update');
        Route::delete('/hapus-jenis/{id}', 'edit')->name('Edit Folder');
    });
    Route::controller(LokasiController::class)->group(function () {
        Route::get('/lokasi', 'read')->name('Lokasi');
        Route::get('/tambah-lokasi', 'create')->name('Tambah Lokasi');
        Route::post('/tambah-lokasi/store', 'store');
        Route::get('/edit-lokasi/{id}', 'edit')->name('Edit Lokasi');
        Route::put('/update-lokasi/{id}', 'update');
        Route::delete('/hapus-lokasi/{id}', 'edit')->name('Edit Lokasi');
    });

    Route::controller(DataPinjamanController::class)->group(function () {
        Route::get('/data-pinjaman', 'read')->name('Data Pinjaman');
        Route::get('/search', 'search')->name('search');
        Route::post('/approve/{id}', 'approve')->name('verifikasi');
    });

    // Route::controller(FilterController::class)->group(function () {
    //     Route::get('/filter', 'index');
    // });
});
require __DIR__ . '/auth.php';
