<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoadController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RouteImportController;
use App\Http\Controllers\ReservationController;


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

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('search', function () {
    return view('search');
})->name('search.index');
Route::get('/', function (){
    return view('home');
})->name('home');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/add/route', [RouteImportController::class, 'indexAddRoutes'])->name('routes.index');
    Route::post('/addroute', [RouteImportController::class, 'routeCheck'])->name('routes.check');
    Route::get('/result/routes', [RouteImportController::class, 'indexRoutes'])->name('routesAdd.index');
    Route::get('/soon',[RegisterController::class, 'registerIndex'])->name('register.index');
});
//TODO: Añadir autentificacion
Route::get('/vouchers', [ReservationController::class, 'getByCode'])->name('search');
Route::get('/vouchers/list', [ReservationController::class, 'search'])->name('searchVouchher');

// Redirect all wrong uri
Route::get('/{any}', [AuthController::class, 'login'])->where('any', '.*')->name('wrongUri');


