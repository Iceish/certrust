<?php

use App\Http\Controllers\dashboard\CertificateController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\ManagementController;
use App\Http\Controllers\dashboard\SettingsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/dashboard')->name('dashboard.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(CertificateController::class)->name('certificates.')->prefix('certificates')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{certificate}/delete', 'destroy')->name('destroy');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{certificate}', 'show')->name('show');
        Route::get('/{certificate}/download/{field}', 'download')->name('download')->where('field', 'public_key|private_key');
    });

    Route::controller(ManagementController::class)->name('management.')->prefix('management')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(SettingsController::class)->name('settings.')->prefix('settings')->group(function () {
        Route::get('/', 'index')->name('index');
    });

});
