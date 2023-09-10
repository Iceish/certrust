<?php

use App\Http\Controllers\dashboard\CertificateController;
use App\Http\Controllers\dashboard\HomeController;
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

    Route::controller(CertificateController::class)->name('certificates.')->prefix('certificates')->group(function () {
        Route::get('/', 'index')->name('index');
//        Route::get('/{brand}/edit', 'edit')->name('edit');
//        Route::post('/{brand}/edit', 'update')->name('update');
//        Route::get('/{brand}/delete', 'destroy')->name('delete');
//        Route::get('/create', 'create')->name('create');
//        Route::post('/create', 'store')->name('store');
//        Route::get('/{brand}', 'show')->name('show');
    });

});
