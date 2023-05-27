<?php

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

Route::get('/clear-cache', function() {
    $exitCode1 = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('config:clear');
    $exitCode3 = Artisan::call('view:clear');
    $exitCode4 = Artisan::call('route:clear');
    // $exitCode2 = Artisan::call('vendor:publish');
    // return what you want
    return "Clear Success";
});


Route::get('/', function () {
    return view('welcome');
});

// Route Admin
Route::resource('/admin/dashboard', App\Http\Controllers\DashboardController::class);
Route::resource('/admin/penduduk', App\Http\Controllers\PendudukController::class);
Route::post('admin/ajaxPenduduk', [App\Http\Controllers\PendudukController::class, 'getData']);
Route::resource('/admin/jenis-dokumen', App\Http\Controllers\JenisDokumenController::class);
Route::post('admin/ajaxJenis-dokumen', [App\Http\Controllers\JenisDokumenController::class, 'getData']);
Route::resource('/admin/syarat-pengajuan', App\Http\Controllers\SyaratPengajuanController::class);
Route::post('admin/ajaxSyarat-pengajuan', [App\Http\Controllers\SyaratPengajuanController::class, 'getData']);
Route::resource('/admin/kelola-dokumen', App\Http\Controllers\KelolaDokumenController::class);
Route::post('admin/ajaxKelola-dokumen', [App\Http\Controllers\KelolaDokumenController::class, 'getData']);

// Route User
Route::resource('/user/dashboard', App\Http\Controllers\DashboardController::class);
Route::resource('/user/kelola-dokumen', App\Http\Controllers\PengajuanController::class);
Route::post('user/ajaxKelola-dokumen', [App\Http\Controllers\PengajuanController::class, 'getData']);

Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', function () {
    return view('auth.login');
});
