<?php

use App\Http\Controllers\BankMasterController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Crew_WO_Controller;
use App\Http\Controllers\CrewBankAccountController;
use App\Http\Controllers\CrewCertificateController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\CrewEducationController;
use App\Http\Controllers\CrewInsuranceController;
use App\Http\Controllers\CrewMedicalRecordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ItemMasterController;
use App\Http\Controllers\JenisIdentitasController;
use App\Http\Controllers\MainGroupController;
use App\Http\Controllers\MasterCrewCertificateController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ShipAccessController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\SubGroupController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VendorController;
use App\Models\CrewMedicalRecord;
use App\Models\Position;

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
    Route::get('read-crew', [CrewController::class, 'read']);
    Route::post('update-crew/{id}', [CrewController::class, 'update']);
    Route::get('/change-status-crew/{id}', [CrewController::class, 'destroy']);
    //routing crew end

    // position routing
    Route::get('position', [PositionController::class, 'index']);
    Route::get('position/{id}', [PositionController::class, 'edit']);
    Route::post('position/{id}', [PositionController::class, 'update']);
    Route::post('position', [PositionController::class, 'store']);
    Route::get('delete-position/{id}', [PositionController::class, 'destroy']);
    Route::get('read-position', [PositionController::class, 'read']);
    // position routing end

    // MASTER Crew Certificate Routing
    Route::get('crew-certificate-master', [MasterCrewCertificateController::class, 'index']);
    Route::get('crew-certificate-master/{id}', [MasterCrewCertificateController::class, 'edit']);
    Route::post('crew-certificate-master/{id}', [MasterCrewCertificateController::class, 'update']);
    Route::post('crew-certificate-master', [MasterCrewCertificateController::class, 'store']);
    Route::get('delete-crew-certificate-master/{id}', [MasterCrewCertificateController::class, 'destroy']);
    Route::get('read-crew-certificate-master', [MasterCrewCertificateController::class, 'read']);
    // MASTER Crew Certificate Routing

    // bank routing
    Route::get('bank', [BankMasterController::class, 'index']);
    Route::get('bank/{id}', [BankMasterController::class, 'edit']);
    Route::post('bank/{id}', [BankMasterController::class, 'update']);
    Route::post('bank', [BankMasterController::class, 'store']);
    Route::get('delete-bank/{id}', [BankMasterController::class, 'destroy']);
    Route::get('read-bank', [BankMasterController::class, 'read']);
    // bank routing end

    // ship access routing
    Route::resource('ship-access', ShipAccessController::class);
    // ship access routing end

    // GROUPING from main-group until part
    Route::get('item', [ItemMasterController::class, 'index']);

    // Main Group
    Route::get('read-main-group', [MainGroupController::class, 'read']);
    Route::post('main-group', [MainGroupController::class, 'store']);
    Route::get('main-group/{id}', [MainGroupController::class, 'show']);
    Route::post('main-group/{id}', [MainGroupController::class, 'update']);
    Route::get('delete-main-group/{id}', [MainGroupController::class, 'destroy']);
    // Main Group (END)

    // GROUPING from main-group until part (END)


    // Main Group Routing
    // Route::resource('main-group', MainGroupController::class);
    // Main Group Routing

    // Group Routing
    Route::resource('group', GroupController::class);
    // Group Routing END

    // sub group routing
    Route::resource('sub-group', SubGroupController::class);
    // sub group routing end

    // unit routing
    Route::resource('unit', UnitController::class);
    // unit routing end

    // component routing
    Route::resource('component', ComponentController::class);
    Route::get('component-is-deleted-to-true/{id}', [ComponentController::class, 'destroy'])->name('component.isDeleted');
    // component routing end

    // part routing
    Route::resource('part', PartController::class);
    Route::get('part-is-deleted-to-true/{id}', [PartController::class, 'destroy'])->name('part.isDeleted');
    // part routing end

    // crew medical record routing
    // Route::resource('crew-medical-record', CrewMedicalRecordController::class);
    Route::post('crew-medical-record', [CrewMedicalRecordController::class, 'store']);
    Route::get('crew-medical-record/{id}', [CrewMedicalRecordController::class, 'show']);
    Route::get('read-crew-medical-record', [CrewMedicalRecordController::class, 'read']);
    Route::post('update-crew-medical-record/{id}', [CrewMedicalRecordController::class, 'update']);
    Route::get('change-status-crew-medical-record/{id}', [CrewMedicalRecordController::class, 'destroy'])->name('crew-medical-record.isDeleted');
    // crew medical record routing end

    // crew WO routing
    // Route::resource('crew-wo', Crew_WO_Controller::class);
    Route::post('crew-wo', [Crew_WO_Controller::class, 'store']);
    Route::get('read-crew-wo', [Crew_WO_Controller::class, 'read']);
    Route::get('crew-wo/{id}', [Crew_WO_Controller::class, 'show']);
    Route::post('crew-wo/{id}', [Crew_WO_Controller::class, 'update']);
    Route::get('change-status-crew-wo/{id}', [Crew_WO_Controller::class, 'destroy'])->name('crew-wo.isDeleted');
    // crew WO routing end

    // crew bank routing
    Route::post('crew-bank', [CrewBankAccountController::class, 'store']);
    Route::get('read-crew-bank', [CrewBankAccountController::class, 'read']);
    Route::get('crew-bank/{id}', [CrewBankAccountController::class, 'show']);
    Route::post('crew-bank/{id}', [CrewBankAccountController::class, 'update']);
    Route::get('change-status-crew-bank/{id}', [CrewBankAccountController::class, 'destroy']);
    // crew bank routing

    // crew certificate routing
    Route::post('crew-certificate', [CrewCertificateController::class, 'store']);
    Route::get('read-crew-certificate', [CrewCertificateController::class, 'read']);
    Route::get('crew-certificate/{id}', [CrewCertificateController::class, 'show']);
    Route::post('crew-certificate/{id}', [CrewCertificateController::class, 'update']);
    Route::get('change-status-crew-certificate/{id}', [CrewCertificateController::class, 'destroy']);
    // crew certificate routing

    // crew insurance routing
    Route::post('crew-insurance', [CrewInsuranceController::class, 'store']);
    Route::get('read-crew-insurance', [CrewInsuranceController::class, 'read']);
    Route::get('crew-insurance/{id}', [CrewInsuranceController::class, 'show']);
    Route::post('crew-insurance/{id}', [CrewInsuranceController::class, 'update']);
    Route::get('change-status-crew-insurance/{id}', [CrewInsuranceController::class, 'destroy']);
    // crew insurance routing

    // crew education routing
    // Route::resource('crew-education', CrewEducationController::class);
    Route::post('crew-education', [CrewEducationController::class, 'store']);
    Route::get('read-crew-education', [CrewEducationController::class, 'read']);
    Route::get('crew-education/{id}', [CrewEducationController::class, 'show']);
    Route::post('crew-education/{id}', [CrewEducationController::class, 'update']);
    Route::get('change-status-crew-education/{id}', [CrewEducationController::class, 'destroy'])->name('crew-education.isDeleted');
    // crew education routing end

    Route::get('/logout', [LoginController::class, 'logout']);
});




