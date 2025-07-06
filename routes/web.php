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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\JadwalMengajarControllerAdmin;
use App\Http\Controllers\admin\MataPelajaranControllerAdmin;
use App\Http\Controllers\Admin\RuangKelasControllerAdmin;

// Route::get('/', [DashboardControllerAdmin::class, 'dashboard'])->name('dashboard');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

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
    Route::post('/lokasi-sekolah/update', [LokasiSekolahControllerAdmin::class, 'updateLokasiSekolah'])->name('updateLokasiSekolah');

    Route::get('/data-absensi', [DataAbsensiControllerAdmin::class, 'dataAbsensi'])->name('dataAbsensi');
    Route::post('/rekap-absensi', [DataAbsensiControllerAdmin::class, 'rekapHariIni']);

    Route::get('/profil', [ProfilControllerAdmin::class, 'profil'])->name('profil');
    Route::post('/profil/update', [ProfilControllerAdmin::class, 'update'])->name('updateProfil');

    route::get('/jadwal-mengajar', [JadwalMengajarControllerAdmin::class, 'index'])->name('jadwalNgajar');
    route::get('/jadwal-ngajar', [JadwalMengajarControllerAdmin::class, 'index'])->name('jadwalNgajar');
    Route::get('/jadwal-mengajar/create', [JadwalMengajarControllerAdmin::class, 'create'])->name('createJadwalNgajar');
    Route::post('/jadwal-mengajar/store', [JadwalMengajarControllerAdmin::class, 'store'])->name('storeJadwalNgajar');
    Route::get('/jadwal-mengajar/edit/{id}', [JadwalMengajarControllerAdmin::class, 'edit'])->name('editJadwalNgajar');
    Route::put('/jadwal-mengajar/update/{id}', [JadwalMengajarControllerAdmin::class, 'update'])->name('updateJadwalNgajar');
    Route::delete('/jadwal-mengajar/delete/{id}', [JadwalMengajarControllerAdmin::class, 'destroy'])->name('destroyJadwalNgajar');

    // Rute untuk pengelolaan Mata Pelajaran
    Route::resource('mata-pelajaran', MataPelajaranControllerAdmin::class)->names([
        'index' => 'admin.mata-pelajaran.index',
        'create' => 'admin.mata-pelajaran.create',
        'store' => 'admin.mata-pelajaran.store', // <--- Pastikan nama ini persis sama
        'show' => 'admin.mata-pelajaran.show',
        'edit' => 'admin.mata-pelajaran.edit',
        'update' => 'admin.mata-pelajaran.update',
        'destroy' => 'admin.mata-pelajaran.destroy',
    ])->parameters([
        'mata-pelajaran' => 'mata_pelajaran' // Penting untuk Route Model Binding di controller
    ]);

    Route::resource('ruang-kelas', RuangKelasControllerAdmin::class);
});

// ===================== Guru =====================
Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [DashboardControllerGuru::class, 'dashboard'])->name('dashboard');

    Route::get('/data-absensi', [DataAbsensiControllerGuru::class, 'dataAbsensi'])->name('dataAbsensi');
    Route::post('/absensi/store', [DataAbsensiControllerGuru::class, 'store'])->name('storeAbsensi');

    Route::get('/rekap-absensi', [RekapAbsensiControllerGuru::class, 'rekapAbsensi'])->name('rekapAbsensi');
    Route::get('/rekap-absensi/export/excel', [RekapAbsensiControllerGuru::class, 'exportExcel'])->name('exportExcel');

    Route::get('/profil', [ProfilControllerGuru::class, 'profil'])->name('profil');
    Route::post('/profil/update', [ProfilControllerGuru::class, 'update'])->name('updateProfil');
});
