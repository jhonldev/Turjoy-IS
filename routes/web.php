<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoadController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\RouteImportController;

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
})->name('login');

Route::get('register', function () {
    return view('register');
})->name('register');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/add/route', [RouteImportController::class, 'indexAddRoutes'])->name('routes.index');
    Route::post('/addroute', [RouteImportController::class, 'routeCheck'])->name('route.check');
    Route::get('/result/routes', [RouteImportController::class, 'indexRoutes'])->name('routesAdd.index');
});
