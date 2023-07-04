<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\PageController;

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

Route::get('/', function () {
    return view('welcome');
})->name("landing");

Route::get("/dashboard/redirect", [PageController::class, "dashboard"])->middleware(["auth"])->name("dashboard");

Route::name("auth.")->group(function () {
    Route::middleware(["guest"])->group(function() {
        Route::get("/login", [AuthController::class, "login"])->name("login");
        Route::get("/register", [AuthController::class, "register"])->name("register");
        Route::post("/authenticate", [AuthController::class, "authenticate"])->name("authenticate");
        Route::post("/register/process", [AuthController::class, "registerProcess"])->name("register.process");
    });
    Route::post("/logout", [AuthController::class, "logout"])->middleware(["auth"])->name("logout");
});

Route::middleware(["auth", "user"])->name("user.")->group(function () {
    Route::get("/dashboard", [DashboardController::class, "dashboard"])->name("dashboard");
});

Route::prefix("/admin")->middleware(["auth", "admin"])->name("admin.")->group(function () {
    Route::get("/dashboard", function() {
        return "dashboard admin bang";
    })->name("dashboard");
});
