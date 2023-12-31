<?php

use App\Http\Controllers\dashboard\CertificateController;
use App\Http\Controllers\dashboard\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::controller(CertificateController::class)->name('certificates.')->prefix('certificates')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::delete('/{certificate}', 'destroy')->name('destroy');
    Route::post('/create', 'store')->name('store');
    Route::get('/{certificate}', 'show')->name('show');
    Route::get('/{certificate}/download/{field}', 'download')->name('download')->where('field', 'public_key|private_key');
    Route::get('/{certificate}/path', 'path')->name('path');
});
