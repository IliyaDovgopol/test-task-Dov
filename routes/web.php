<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/pageA', [PageController::class, 'pageA'])->name('pageA');
    Route::post('/buy-cow', [PageController::class, 'buyCow'])->name('buyCow');

    Route::get('/pageB', [PageController::class, 'pageB'])->name('pageB');
    Route::post('/download', [PageController::class, 'download'])->name('download');

    // Административные страницы (доступны только для админов)
    Route::middleware('admin')->group(function () {
        Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    });
});
