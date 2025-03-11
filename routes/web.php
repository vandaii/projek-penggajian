<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KomponenGajiController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['link' => '/dashboard', 'title' => 'Dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/hapus', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('admin/dashboard', 'index')->middleware(['auth', 'admin'])->name('admin.dashboard');
    Route::get('admin/create', 'create')->middleware(['auth', 'admin'])->name('karyawan.create');
    Route::post('admin/create', 'store')->middleware(['auth', 'admin'])->name('karyawan.store');
    Route::get('dashboard/karyawan/profile/{id}', 'show')->middleware(['auth', 'admin'])->name('karyawan.profile');
    Route::get('dashboard/karyawan/{id}', 'edit')->middleware(['auth', 'admin'])->name('karyawan.edit');
    Route::put('dashboard/karyawan/{id}', 'update')->middleware(['auth', 'admin'])->name('karyawan.update');
    Route::delete('dashboard/karyawan/{id}', 'destroy')->middleware(['auth', 'admin'])->name('karyawan.destroy');
});

Route::controller(JabatanController::class)->group(function () {
    Route::get('admin/jabatan', 'index')->middleware(['auth', 'admin'])->name('jabatan.index');
    Route::get('admin/jabatan/create', 'create')->middleware(['auth', 'admin'])->name('jabatan.create');
    Route::post('admin/jabatan/create', 'store')->middleware(['auth', 'admin'])->name('jabatan.store');
    Route::get('admin/jabatan/show/{id}', 'show')->middleware(['auth', 'admin'])->name('jabatan.show');
    Route::get('admin/jabatan/{id}', 'edit')->middleware(['auth', 'admin'])->name('jabatan.edit');
    Route::put('admin/jabatan/{id}', 'update')->middleware(['auth', 'admin'])->name('jabatan.update');
    Route::delete('admin/jabatan/{id}', 'destroy')->middleware(['auth', 'admin'])->name('jabatan.destroy');
});

Route::controller(DivisiController::class)->group(function () {
    Route::get('admin/divisi', 'index')->middleware(['auth', 'admin'])->name('divisi.index');
    Route::get('admin/divisi/create', 'create')->middleware(['auth', 'admin'])->name('divisi.create');
    Route::post('admin/divisi/create', 'store')->middleware(['auth', 'admin'])->name('divisi.store');
    Route::get('admin/divisi/show/{id}', 'show')->middleware(['auth', 'admin'])->name('divisi.show');
    Route::get('admin/divisi/{id}', 'edit')->middleware(['auth', 'admin'])->name('divisi.edit');
    Route::put('admin/divisi/{id}', 'update')->middleware(['auth', 'admin'])->name('divisi.update');
    Route::delete('admin/divisi/{id}', 'destroy')->middleware(['auth', 'admin'])->name('divisi.destroy');
});

Route::controller(AbsenController::class)->group(function () {
    Route::get('absen', 'index')->name('absen.index');
    Route::get('absen/create', 'create')->name('absen.create');
    Route::post('absen/create', 'store')->name('absen.store');
    Route::get('absen/show/{id}', 'show')->name('absen.show');
    Route::get('admin/absen/{id}', 'edit')->middleware(['auth', 'admin'])->name('absen.edit');
    Route::put('admin/absen/{id}', 'update')->middleware(['auth', 'admin'])->name('absen.update');
    Route::delete('admin/absen/{id}', 'destroy')->middleware(['auth', 'admin'])->name('absen.destroy');
});

Route::controller(KomponenGajiController::class)->group(function () {
    Route::get('admin/komponen_gaji', 'index')->middleware(['auth', 'admin'])->name('komponen_gaji.index');
    Route::get('admin/komponen_gaji/create', 'create')->middleware(['auth', 'admin'])->name('komponen_gaji.create');
    Route::post('admin/komponen_gaji/create', 'store')->middleware(['auth', 'admin'])->name('komponen_gaji.store');
    Route::get('admin/komponen_gaji/show/{id}', 'show')->middleware(['auth', 'admin'])->name('komponen_gaji.show');
    Route::get('admin/komponen_gaji/{id}', 'edit')->middleware(['auth', 'admin'])->name('komponen_gaji.edit');
    Route::put('admin/komponen_gaji/{id}', 'update')->middleware(['auth', 'admin'])->name('komponen_gaji.update');
    Route::delete('admin/komponen_gaji/{id}', 'destroy')->middleware(['auth', 'admin'])->name('komponen_gaji.destroy');
});

Route::controller(PenggajianController::class)->group(function () {
    Route::get('penggajian', 'index')->name('penggajian.index');
    Route::get('penggajian/create', 'create')->name('penggajian.create');
    Route::post('penggajian/create', 'store')->name('penggajian.store');
    Route::get('penggajian/show/{id}', 'show')->name('penggajian.show');
    Route::get('penggajian/{id}', 'edit')->name('penggajian.edit');
    Route::put('penggajian/{id}', 'update')->name('penggajian.update');
    Route::delete('penggajian/{id}', 'destroy')->name('penggajian.destroy');
    Route::get('gaji_semua', 'gajiSemua')->name('penggajian.gajiSemua');
    Route::get('gaji_karyawan/{id}', 'gajiKaryawan')->name('penggajian.gajiKaryawan');
    Route::get('gaji_karyawan/slip_gaji', 'slipGajiSemua')->name('penggajian.slipGajiSemua');
    Route::get('gaji_karyawan/slip_gaji/{id}', 'slipGaji')->name('penggajian.slipGaji');
});

require __DIR__ . '/auth.php';
