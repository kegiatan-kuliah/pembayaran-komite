<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/login', 'login')->name('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });
    
    Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });
    
    Route::controller(KelasController::class)->prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });
    
    Route::controller(AngkatanController::class)->prefix('angkatan')->name('angkatan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });
    
    Route::controller(SiswaController::class)->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/filter', 'filter')->name('filter');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });
    
    Route::controller(TagihanController::class)->prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/paid', 'paid')->name('paid');
        Route::post('/confirm', 'confirm')->name('confirm');
        Route::get('/history', 'history')->name('history');
        Route::get('/receipt/{id}', 'receipt')->name('receipt');
    });

    Route::controller(ReportController::class)->prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/process', 'process')->name('process');
        Route::post('/print', 'print')->name('print');
        Route::get('/result', 'result')->name('result');
    });
});

