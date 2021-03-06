<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*--------------------------- Login, Register & Logout ---------------------------*/
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login-post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [LoginController::class, 'register'])->name('register');


/*--------------------------- Route Group with Auth Middleware ---------------------------*/
Route::middleware(['auth'])->group(function () {

    /*--------------------------- Home ---------------------------*/
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::post('upload/files', [UploadController::class, 'upload'])->name('upload-files');

});
