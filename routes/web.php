<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CrewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\JenisIdentitasController;
use App\Http\Controllers\MainGroupController;
use App\Http\Controllers\ShipAccessController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\SubGroupController;
use App\Http\Controllers\VendorController;

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



Route::middleware('guest')->group(function(){
    Route::get('/', [ LoginController::class, 'showFormLogin' ]);
    Route::post('/', [ LoginController::class, 'authenticate' ]);
});

// Route::get('dashboard', [ LoginController::class, 'dashboard' ])->middleware('auth');

Route::middleware('auth')->group(function(){
    
    Route::get('/dashboard', function(){
        return view('dashboard.dashboard');
    })->name('main.dashboard');

    // ship Routing
    Route::resource('ship', ShipController::class);
    Route::get('/change-status-ship/{id}', [ShipController::class, 'destroy']);
    // ship routing end

    // vendor routing
    Route::resource('vendors', VendorController::class);
    Route::get('/change-status-vendor/{id}', [VendorController::class, 'destroy']);
    // vendor routing end

    // routing departement
    Route::resource('departement', DepartementController::class);
    Route::get("/change-status-departement/{id}", [DepartementController::class, 'destroy'])->name('departement.changestatus');
    // routing departement end

    // routing contry
    Route::resource('country', CountryController::class);
    Route::get('/change-status-country/{id}', [CountryController::class, 'destroy'])->name('country.changestatus');
    // routing contry end

    // routing identity-type
    Route::resource('identity-type', JenisIdentitasController::class);
    // routing identity-type end

    //routing crew
    Route::resource('crew', CrewController::class);
    Route::get('/change-status-crew/{id}', [CrewController::class, 'destroy']);
    //routing crew end

    // ship access routing
    Route::resource('ship-access', ShipAccessController::class);
    // ship access routing end

    // Main Group Routing
    Route::resource('main-group', MainGroupController::class);
    // Main Group Routing

    // Group Routing
    Route::resource('group', GroupController::class);
    // Group Routing END

    // sub group routing
    Route::resource('sub-group', SubGroupController::class);
    // sub group routing end

    Route::get('/logout', [LoginController::class, 'logout']);
});




