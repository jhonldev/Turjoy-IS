<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\auth\LoadController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\RouteImportController;
use App\Http\Controllers\RouteController;
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

Route::get('daily', function () {
    return view('dailyRoutes');
})->name('dailyRoutes');

Route::get('/', [RouteController::class, 'homeIndex'])->name('home');

Route::get('/get/origins', [RouteController::class, 'originIndex']);
Route::get('/get/destinations/{origin}', [RouteController::class, 'searchDestinations']);
Route::get('/seating/{origin}/{destination}/{date}', [RouteController::class, 'seatings']);

// Reservation
Route::post('/reservation', [ReservationController::class, 'store'])->name('add-reservation');

// Voucher
Route::get('/travel-reservation/{id}', [ReservationController::class, 'generatePDF'])->name('generate-pdf');
Route::get('download-pdf/{id}', [ReservationController::class, 'downloadPDF'])->name('pdf.download');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    // Travel routes
    Route::get('/add/route', [RouteImportController::class, 'indexAddRoutes'])->name('routes.index');
    Route::post('/addroute', [RouteImportController::class, 'routeCheck'])->name('routes.check');
    Route::get('/result/routes', [RouteImportController::class, 'indexRoutes'])->name('routesAdd.index');

    // Reservation report
    Route::get('/reservation/report', [ReservationController::class, 'reservationReportIndex'])->name('report-reservation.index');
    Route::get('/search-reservation', [ReservationController::class, 'searchToDate'])->name('searchToDate');
});

Route::get('/vouchers', [ReservationController::class, 'getByCode'])->name('search');
Route::get('/vouchers/list', [ReservationController::class, 'search'])->name('searchVoucher');

Route::get('/daily', [RouteController::class, 'dailyRoutes'])->name('dailyRoutes');

// Redirect all wrong uri
Route::get('/{any}', [AuthController::class, 'login'])->where('any', '.*')->name('wrongUri');


