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
Route::get('/', function () {
    return view('employee.welcome');
});
*/



Route::controller(LoginRegisterController::class)->group(function() {
    Route::GET('/register', 'register')->name('register');
    Route::GET('/store', 'store')->name('store');
    Route::GET('/login', 'login')->name('login');
    Route::GET('/authenticate', 'authenticate')->name('authenticate');
    Route::GET('/', 'home')->name('home');
    Route::POST('/logout', 'logout')->name('logout');
});