<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PinjamController;
use App\Http\Controllers\DataPinjamanController;
use App\Http\Controllers\DokMasterController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TahapanController;


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

Route::controller(PinjamController::class)->group(function () {
    Route::get('/', 'read')->name('Form Pinjam');
    Route::post('/pinjam-dokumen/store', 'store');
});

Route::middleware('auth')->group(function () {
    Route::controller(DokMasterController::class)->group(function () {
        Route::get('/dashboard', 'read')->name('dashboard');
        Route::get('/lihat-data/{id}', 'lihat')->name('Lihat Data');
        Route::get('/tambah-data', 'create')->name('Tambahkan Data');
        Route::post('/tambah-data/store', 'store');
        Route::get('/edit-data/{id}', 'edit')->name('Edit Data');
        Route::put('/update-data/{id}', 'update');
        Route::delete('/hapus-data/{id}', 'delete');
    });
    Route::controller(FolderController::class)->group(function () {
        Route::get('/folder', 'read')->name('Folder');
        Route::get('/get-tree-folder', 'treeFolder')->name('TreeFolder');
        Route::post('/store-folder', 'store')->name('StoreFolder');
        Route::post('/hapus-folder', 'hapus')->name('hapusFolder');;
    });
    Route::controller(JenisDokumenController::class)->group(function () {
        Route::get('/jenis-dokumen', 'read')->name('Jenis Dokumen');
        Route::get('/tambah-jenis', 'create')->name('Tambah Jenis Dokumen');
        Route::post('/tambah-jenis/store', 'store');
        Route::get('/edit-jenis/{id}', 'edit')->name('Edit Jenis Dokumen');
        Route::put('/update-jenis/{id}', 'update');
        Route::delete('/hapus-jenis/{id}', 'edit')->name('Edit Folder');
    });
    // Route::controller(LokasiController::class)->group(function () {
    //     Route::get('/lokasi', 'read')->name('Lokasi');
    //     Route::get('/tambah-lokasi', 'create')->name('Tambah Lokasi');
    //     Route::post('/tambah-lokasi/store', 'store');
    //     Route::get('/edit-lokasi/{id}', 'edit')->name('Edit Lokasi');
    //     Route::put('/update-lokasi/{id}', 'update');
    //     Route::delete('/hapus-lokasi/{id}', 'delete')->name('Hapus Lokasi');
    // });
    Route::controller(DataPinjamanController::class)->group(function () {
        Route::get('/data-pinjaman', 'read')->name('Data Pinjaman');
        Route::get('/search', 'search')->name('search');
        Route::post('/approve/{id}', 'approve')->name('verifikasi');
    });
    Route::controller(TahapanController::class)->group(function () {
        Route::group(['prefix' => 'tahapan'], function () {
            Route::get('/', 'index')->name('masterTahapan');
            Route::get('/detail/{id}', 'detail')->name('detailTahapan');
            Route::post('/store', 'store')->name('storeTahapan');
        });
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'read')->name('Data User');
        Route::get('/profil/{id}', 'lihat')->name('Profil');
        Route::get('/tambah-user', 'create')->name('Tambah User');
        Route::post('/tambah-user/store', 'store');
        Route::get('/edit-user/{id}', 'edit')->name('Edit User');
        Route::put('/update-user/{id}', 'update');
        Route::delete('/hapus-user/{id}', 'delete')->name('hapus User');
    });
});
require __DIR__ . '/auth.php';
