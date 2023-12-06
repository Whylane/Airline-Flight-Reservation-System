<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AirlineController as AdminAirlineController;
use App\Http\Controllers\Admin\AirportController as AdminAirportController;
use App\Http\Controllers\Admin\FlightController as AdminFlightController;
use App\Http\Controllers\Admin\PassengerController as AdminPassengerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Superadmin\FlightController as SuperadminFlightController;
use App\Http\Controllers\Superadmin\AirlineController as SuperadminAirlineController;
use App\Http\Controllers\Superadmin\AirportController as SuperadminAirportController;
use App\Http\Controllers\Superadmin\PassengerController as SuperadminPassengerController;
use App\Http\Controllers\Superadmin\UserController as SuperadminUserController;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'index']);

Auth::routes(['verify' => true]);

// Superadmin Routes
Route::group(['middleware' => ['auth', 'role:superadmin'], 'prefix' => 'superadmin'], function () {

    // Superadmin Dashboard
    Route::get('dashboard', [SuperadminController::class, 'index']);
    Route::post('delay-flight/{id}', [SuperadminController::class, 'delayFlight']);
    Route::post('move-back/{id}', [SuperadminController::class, 'moveFlight']);
    Route::get('user-lists', [SuperadminController::class, 'user']);
    Route::get('add-admin', [SuperadminUserController::class, 'addAdmin']);
    Route::post('store-admin', [SuperadminUserController::class, 'storeAdmin']);

    // Flight Routes
    Route::get('flight-lists', [SuperadminFlightController::class,'index']);
    // Route::get('create-flight', [SuperadminFlightController::class,'create']);
    // Route::post('store-flight', [SuperadminFlightController::class, 'store']);
    // Route::get('edit-flight/{id}', [SuperadminFlightController::class, 'edit']);
    // Route::put('update-flight/{id}', [SuperadminFlightController::class, 'update']);
    Route::get('report', [SuperadminFlightController::class, 'report'])->name('report.index');
    Route::post('approve-flight/{id}', [SuperadminFlightController::class, 'approveFlight']);
    Route::post('reject-flight/{id}', [SuperadminFlightController::class, 'rejectFlight']);

    // Airline Routes
    Route::get('airline-lists', [SuperadminAirlineController::class, 'index']);
    Route::get('create-airline', [SuperadminAirlineController::class, 'create']);
    Route::post('store-airline', [SuperadminAirlineController::class, 'store']);
    Route::get('edit-airline/{id}', [SuperadminAirlineController::class, 'edit']);
    Route::put('update-airline/{id}', [SuperadminAirlineController::class, 'update']);
    // Route::get('view-airline/{id}', [SuperadminAirlineController::class, 'view']);

    // Airport Routes
    Route::get('airport-lists', [SuperadminAirportController::class, 'index']);
    Route::get('create-airport', [SuperadminAirportController::class, 'create']);
    Route::post('store-airport', [SuperadminAirportController::class, 'store']);
    Route::get('edit-airport/{id}', [SuperadminAirportController::class, 'edit']);
    Route::put('update-airport/{id}', [SuperadminAirportController::class, 'update']);

    // Passenger List Routes
    Route::get('passenger-lists', [SuperadminPassengerController::class, 'index']);
    Route::get('view-details/{id}', [SuperadminPassengerController::class, 'show']);
    Route::put('update-tickets/{id}', [SuperadminPassengerController::class, 'updateTicket']);
    Route::get('passenger-history', [SuperadminPassengerController::class, 'history']);
    

});

// Admin Routes
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {

    // Admin Dashboard
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::post('delay-flight/{id}', [AdminController::class, 'delayFlight']);
    Route::post('move-back/{id}', [AdminController::class, 'moveFlight']);
    
    
    // Flight Routes
    Route::get('flight', [AdminFlightController::class, 'index']);
    Route::get('create-flight', [AdminFlightController::class, 'create']);
    Route::post('store-flight', [AdminFlightController::class, 'store']);
    Route::get('edit-flight/{id}', [AdminFlightController::class, 'edit']);
    Route::put('update-flight/{id}', [AdminFlightController::class, 'update']);
    Route::get('report', [AdminFlightController::class, 'report'])->name('report.index');

    // Passenger List Routes
    Route::get('passenger', [AdminPassengerController::class, 'index']);
    Route::get('view-details/{id}', [AdminPassengerController::class, 'show']);
    Route::put('update-tickets/{id}', [AdminPassengerController::class, 'updateTicket']);
    Route::get('passenger-history', [AdminPassengerController::class, 'history']);

    // Airline Routes
    Route::get('airline', [AdminAirlineController::class, 'index']);
    Route::get('create-airline', [AdminAirlineController::class, 'create']);
    Route::post('store-airline', [AdminAirlineController::class, 'store']);
    Route::get('edit-airline/{id}', [AdminAirlineController::class, 'edit']);
    Route::put('update-airline/{id}', [AdminAirlineController::class, 'update']);

    // Airport Routes
    Route::get('airport', [AdminAirportController::class, 'index']);
    Route::get('create-airport', [AdminAirportController::class, 'create']);
    Route::post('store-airport', [AdminAirportController::class, 'store']);
    Route::get('edit-airport/{id}', [AdminAirportController::class, 'edit']);
    Route::put('update-airport/{id}', [AdminAirportController::class, 'update']);
});

// Passenger Routes
Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user'], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::resource('/booking', BookingController::class);
    Route::post('/cancelflight', [BookingController::class, 'cancelFlight'])->name('cancel-flight');
    Route::post('/rebook-flight', [BookingController::class, 'rebookFlight'])->name('rebook-flight');
    Route::get('/policy', [UserController::class, 'policy']);
    Route::get('/about', [UserController::class, 'about']);
});

// Ticket
Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('myFlights', [TicketsController::class, 'index'])->name('tickets.index');
    Route::get('tickets/{id}', [TicketsController::class, 'show'])->name('tickets.show');

    Route::get('/passenger-details/{id}', [SearchController::class, 'passengerDetails'])->name('continue-passenger-details');
});

// Search
Route::get('/flight-list', [UserController::class, 'flightList']);
Route::get('/search/flight-list', [SearchController::class, 'searchResults'])->name('search-flight.results');
Route::get('/passenger-details/{id}', [SearchController::class, 'passengerDetails'])->name('continue-passenger-details');
Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/rate-flight', [FeedbackController::class, 'rateFlight'])->name('rate-flight');
// Route::get('/return-flight-list', [UserController::class, 'returnflightList'])->name('return-flight-list');
// Route::get('/return-search/flight-list', [SearchController::class, 'returnSearchResults'])->name('return-search-flight.results');

Route::get('/policy', [FrontendController::class, 'policy']);
Route::get('/about', [FrontendController::class, 'about']);