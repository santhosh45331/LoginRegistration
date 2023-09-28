<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;

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
Route::group(['middleware' => ['web']], function () {
    Route::controller(LoginRegisterController::class)->group(function() {
        Route::GET('/', 'home')->name('home');
        Route::GET('/register', 'register')->name('register');
        Route::POST('/store', 'store')->name('store');
        Route::GET('/login', 'login')->name('login');
        Route::POST('/authenticate', 'authenticate')->name('authenticate');
        Route::POST('/logout', 'logout')->name('logout');
});
});