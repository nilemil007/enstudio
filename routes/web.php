<?php

use App\Http\Controllers\BpController;
use App\Http\Controllers\BtsController;
use App\Http\Controllers\CoreActivationController;
use App\Http\Controllers\DdHouseController;
use App\Http\Controllers\HouseCodeActivationController;
use App\Http\Controllers\ItopReplaceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RsoController;
use App\Http\Controllers\ScratchCardSerialController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TradeCampaignRetailerCodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth/login');
});


Route::middleware(['auth'])->group(function (){
    // Dashboard
    Route::get('/dashboard', function (){
        return view('dashboard');
    })->name('dashboard');


    // Itop Replace Additional Routes
    Route::prefix('/itop-replace')->controller( ItopReplaceController::class )->name('itop-replace.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
    });

    // User Additional Routes
    Route::prefix('/user')->controller( UserController::class )->name('user.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Update password
        Route::patch('/password/update/{user}','passwordUpdate')->name('password.update');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // DD House Additional Routes
    Route::prefix('/dd-house')->controller( DdHouseController::class )->name('dd-house.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // Supervisor Additional Routes
    Route::prefix('/supervisor')->controller( SupervisorController::class )->name('supervisor.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Get user by dd house
        Route::post('/get_users_by_dd_house/{house_id?}', 'getUsersByDdHouse')->name('get.users.by.dd.house');
    });

    // Rso Additional Routes
    Route::controller(RsoController::class )->prefix('/rso')->name('rso.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // BP Additional Routes
    Route::controller(BpController::class )->prefix('/bp')->name('bp.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
        // Get supervisors by dd house
        Route::post('/get_supervisors_by_dd_house/{house_id?}', 'getSupervisorsByDdHouse')->name('get.supervisors.by.dd.house');
        // Get user by dd house
        Route::post('/get_user_by_dd_house/{house_id?}', 'getUserByDdHouse')->name('get.user.by.dd.house');
    });

    // Route Additional Routes
    Route::controller(RouteController::class )->prefix('/route')->name('route.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // Retailer Additional Routes
    Route::controller(RetailerController::class )->prefix('/retailer')->name('retailer.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // BTS Additional Routes
    Route::controller(BtsController::class )->prefix('/bts')->name('bts.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // House Code Activation Additional Routes
    Route::controller(HouseCodeActivationController::class )->prefix('/hca')->name('hca.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Summary
        Route::get('/summary','summary')->name('summary');
        // Export
        Route::get('/export','export')->name('export');
        // Export [Last Month Data]
        Route::get('/export-last-month','exportLastMonth')->name('export.last.month');
        // LMTD
        Route::get('/lmtd', 'lmtd')->name('lmtd');
    });

    // Trade Campaign Retailer Code Additional Routes
    Route::controller( TradeCampaignRetailerCodeController::class )->prefix('/tcrc')->name('tcrc.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
    });

    // Scratch Card Serial Additional Routes
    Route::controller(ScratchCardSerialController::class )->prefix('/sc-serial')->name('sc-serial.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
    });

    // Core Data Import Routes
    Route::controller( CoreActivationController::class )->prefix('/core')->name('core.')->group(function (){
        // Activation [view]
        Route::get('/activation','index')->name('activation');
        // Activation [import]
        Route::post('/activation/import','coreActivationImport')->name('activation.import');
    });

    // Report Routes
    Route::controller(ReportController::class)->prefix('/report')->name('report.')->group(function(){
        // Activation Summary
        Route::get('/activation/summary','coreActivationSummary')->name('activation.summary');
    });

    // Daily Report Routes
    Route::controller(ReportController::class)->prefix('/daily-report')->name('daily.report.')->group(function(){
        // GA
        Route::get('/ga','ga')->name('ga');
    });

    // Resource Routes
    Route::resources([
        'itop-replace'  => ItopReplaceController::class,
        'user'          => UserController::class,
        'dd-house'      => DdHouseController::class,
        'supervisor'    => SupervisorController::class,
        'rso'           => RsoController::class,
        'bp'            => BpController::class,
        'route'         => RouteController::class,
        'retailer'      => RetailerController::class,
        'bts'           => BtsController::class,
        'hca'           => HouseCodeActivationController::class,
        'tcrc'          => TradeCampaignRetailerCodeController::class,
        'sc-serial'     => ScratchCardSerialController::class,
    ]);

});


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
