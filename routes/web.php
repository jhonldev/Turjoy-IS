<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoadController;
use App\Http\Controllers\auth\AuthController;

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
    return view('auth.login');
});

Route::get('register', function () {
    return view('register');
})->name('register');


Route::get('login', [AuthController::class, 'login'])->name('login');

Route::get('loadRoute', [LoadController::class, 'create'])->name('loadRoute');

Route::get('loadRoute', [LoadController::class, 'route'])->name('loadRoute.route');

/*Route::middleware('auth')->group(function () {
  Route::get('loadRoute', [LoadController::class, 'create'])->name('loadRoute');
);*/
