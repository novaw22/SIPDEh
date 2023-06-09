<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

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

Route::prefix("/")->name("user.pengajuan.")->group(function () {
    Route::get("/pengajuan/{jenis_dokumen}")->name("show");
    Route::post("/pengajuan/save")->name("save");
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

Route::prefix("/user")->name("user.")->group(function() {
    Route::get("/dashboard", [App\Http\Controllers\DashboardController::class, "index"]);
    Route::resource('documents', App\Http\Controllers\PengajuanController::class)->middleware('auth');
});
// Route::resource('/user/dashboard', App\Http\Controllers\DashboardController::class);
Route::post('user/ajaxKelola-dokumen', [App\Http\Controllers\PengajuanController::class, 'getData']);

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
