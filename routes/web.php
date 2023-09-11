<?php

use App\Http\Controllers\dashboard\AuthorityController;
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

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(AuthorityController::class)->name('authorities.')->prefix('authorities')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{authority}/delete', 'destroy')->name('destroy');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{authority}', 'show')->name('show');
    });

});
