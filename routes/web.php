<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardControllerAdmin;
use App\Http\Controllers\admin\DataGuruControllerAdmin;
use App\Http\Controllers\admin\LokasiSekolahControllerAdmin;
use App\Http\Controllers\admin\DataAbsensiControllerAdmin;
use App\Http\Controllers\admin\ProfilControllerAdmin;
use App\Http\Controllers\guru\DashboardControllerGuru;
use App\Http\Controllers\guru\DataAbsensiControllerGuru;
use App\Http\Controllers\guru\RekapAbsensiControllerGuru;
use App\Http\Controllers\guru\ProfilControllerGuru;

Route::get('/', [DashboardControllerAdmin::class, 'dashboard'])->name('dashboard');

// ===================== Admin =====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardControllerAdmin::class, 'dashboard'])->name('dashboard');

    Route::get('/data-guru', [DataGuruControllerAdmin::class, 'dataGuru'])->name('dataGuru');
    Route::get('/data-guru/create', [DataGuruControllerAdmin::class, 'create'])->name('create');
    Route::post('/data-guru/store', [DataGuruControllerAdmin::class, 'store'])->name('store');
    Route::get('/data-guru/edit/{id}', [DataGuruControllerAdmin::class, 'edit'])->name('edit');
    Route::put('/data-guru/update/{id}', [DataGuruControllerAdmin::class, 'update'])->name('update');
    Route::delete('/data-guru/delete/{id}', [DataGuruControllerAdmin::class, 'destroy'])->name('destroy');


    Route::get('/lokasi-sekolah', [LokasiSekolahControllerAdmin::class, 'lokasiSekolah'])->name('lokasiSekolah');

    Route::get('/data-absensi', [DataAbsensiControllerAdmin::class, 'dataAbsensi'])->name('dataAbsensi');

    Route::get('/profil', [ProfilControllerAdmin::class, 'profil'])->name('profil');
});

// ===================== Guru =====================
Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [DashboardControllerGuru::class, 'dashboard'])->name('dashboard');

    Route::get('/data-absensi', [DataAbsensiControllerGuru::class, 'dataAbsensi'])->name('dataAbsensi');
    Route::post('/data-absensi/store', [DataAbsensiControllerGuru::class, 'store'])->name('storeAbsensi');

    Route::get('/rekap-absensi', [RekapAbsensiControllerGuru::class, 'rekapAbsensi'])->name('rekapAbsensi');
    Route::get('/rekap-absensi/export/excel', [RekapAbsensiControllerGuru::class, 'exportExcel'])->name('exportExcel');



    Route::get('/profil', [ProfilControllerGuru::class, 'profil'])->name('profil');
});
