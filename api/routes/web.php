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

Route::get('/debug', function () {
    return "Debug view..";
});
