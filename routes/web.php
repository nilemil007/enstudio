<?php

use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BpController;
use App\Http\Controllers\CmController;
use App\Http\Controllers\BtsController;
use App\Http\Controllers\RsoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DdHouseController;
use App\Http\Controllers\LiftingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\KpiTargetController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ItopReplaceController;
use App\Http\Controllers\CoreActivationController;
use App\Http\Controllers\ProductAndTypeController;
use App\Http\Controllers\ScratchCardSerialController;
use App\Http\Controllers\HouseCodeActivationController;
use App\Http\Controllers\TradeCampaignRetailerCodeController;


Route::get('/', function () {
    return view('auth/login');
})->name('login');


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
        // Update password
        Route::patch('/password/update/{user}','passwordUpdate')->name('password.update');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
        // Move To Trash
        Route::get('/trash','trash')->name('trash');
        // Restore
        Route::get('/restore/{id}','restore')->name('restore');
        // Permanently Delete
        Route::delete('/permanently-delete/{id}','permanentlyDelete')->name('permanently.delete');
        // Permanently Delete all
        Route::delete('/permanently/delete/all','permanentlyDeleteAll')->name('permanently.delete.all');
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
        // Get Users, Supervisors, Routes
        Route::post('/get_users_supervisors_routes/{houseId?}', 'getUsersSupervisorsRoutes')->name('get.users.supervisors.routes.by.dd.house');
        // Move To Trash
        Route::get('/trash','trash')->name('trash');
        // Restore
        Route::get('/restore/{id}','restore')->name('restore');
        // Permanently Delete
        Route::delete('/permanently-delete/{id}','permanentlyDelete')->name('permanently.delete');
    });

    // BP Additional Routes
    Route::controller(BpController::class )->prefix('/bp')->name('bp.')->group(function (){
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
        // Get supervisors and users by dd house
        Route::post('/get_supervisors_users/{house_id?}', 'getSupervisorsAndUsers')->name('get.supervisors.users');
        // Move To Trash
        Route::get('/trash','trash')->name('trash');
        // Restore
        Route::get('/restore/{id}','restore')->name('restore');
        // Permanently Delete
        Route::delete('/permanently-delete/{id}','permanentlyDelete')->name('permanently.delete');
        // Permanently Delete All
        Route::delete('/delete/all','permanentlyDeleteAll')->name('permanently.delete.all');
    });

    // CM Additional Routes
    Route::controller(CmController::class )->prefix('/cm')->name('cm.')->group(function (){
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
        // Get users by dd house
        Route::post('/get_users/{house_id?}', 'getUsers')->name('get.users');
        // Move To Trash
        Route::get('/trash','trash')->name('trash');
        // Restore
        Route::get('/restore/{id}','restore')->name('restore');
        // Permanently Delete
        Route::delete('/permanently-delete/{id}','permanentlyDelete')->name('permanently.delete');
        // Permanently Delete All
        Route::delete('/delete/all','permanentlyDeleteAll')->name('permanently.delete.all');
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
        // Export
        Route::get('/export','export')->name('export');
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
        // Export [Current Month Data]
        Route::get('/export','export')->name('export');
        // Export [Last Month Data]
        Route::get('/export-last-month','exportLastMonth')->name('export.last.month');
        // LMTD
        Route::get('/lmtd', 'lmtd')->name('lmtd');
        // Get retailer code by user
        Route::post('/get_retailer_code/{user_id?}', 'getRetailerCode')->name('get.retailer.code');
    });

    // Trade Campaign Retailer Code Additional Routes
    Route::controller( TradeCampaignRetailerCodeController::class )->prefix('/tcrc')->name('tcrc.')->group(function (){
        // Get users by flag
        Route::post('/users/{flag?}','getUsersByFlag')->name('get.users');
        // Move To Trash
        Route::get('/trash','trash')->name('trash');
        // Restore
        Route::get('/restore/{id}','restore')->name('restore');
        // Permanently Delete
        Route::delete('/permanently-delete/{id}','permanentlyDelete')->name('permanently.delete');
        // All codes will be valid this month as well.
        Route::get('/valid-in-current-month', 'validInCurrentMonth')->name('valid.in.current.month');
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
        // Get retailers by house
        Route::post('/get/retailer/{id?}','getRetailerByHouse')->name('get.retailer');
    });

    // Daily Report Routes
    Route::controller(ReportController::class)->prefix('/daily-report')->name('daily.report.')->group(function(){
        // GA
        Route::get('/ga','ga')->name('ga');
        // Get rso by dd house
        Route::post('/get_rso/{house_id?}', 'getRso')->name('get.rso');
    });

    // KPI Target Additional Routes
    Route::controller(KpiTargetController::class )->prefix('/kpi-target')->name('kpi-target.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // Settings Additional Routes
    Route::controller(SettingController::class )->prefix('/settings')->name('settings.')->group(function (){
        // General View
        Route::get('/general','general')->name('general');
        // General Update
        Route::post('/general','generalUpdate')->name('general.update');
        // Shera Partner
        Route::get('/shera-partner','sheraPartner')->name('shera.partner');
        // Shera Partner Update
        Route::post('/shera-partner','sheraPartnerUpdate')->name('shera.partner.update');
    });

    // Lifting Additional Routes
    Route::controller(LiftingController::class )->prefix('/lifting')->name('lifting.')->group(function (){
        // Move To Trash
        Route::get('/trash','trash')->name('trash');
        // Restore
        Route::get('/restore/{id}','restore')->name('restore');
        // Permanently Delete
        Route::delete('/permanently-delete/{id}','permanentlyDelete')->name('permanently.delete');
        // Permanently Delete All
        Route::delete('/delete/all','permanentlyDeleteAll')->name('permanently.delete.all');
        // Lifting Calculation
        Route::get('/calculation', 'calculation')->name('calculation');
        // Get price by product
//        Route::get('/get_price_by_product/{product?}', 'getPriceByProduct')->name('get.price.by.product');
        // Get itop amount
//        Route::get('/get_itop_amount/{total_amount?}/{dd_id?}/{date?}', 'getItopAmount')->name('get.itop.amount');
    });

    // Resource Routes
    Route::resources([
        'itop-replace'  => ItopReplaceController::class,
        'user'          => UserController::class,
        'dd-house'      => DdHouseController::class,
        'supervisor'    => SupervisorController::class,
        'rso'           => RsoController::class,
        'cm'            => CmController::class,
        'bp'            => BpController::class,
        'route'         => RouteController::class,
        'retailer'      => RetailerController::class,
        'bts'           => BtsController::class,
        'hca'           => HouseCodeActivationController::class,
        'tcrc'          => TradeCampaignRetailerCodeController::class,
        'sc-serial'     => ScratchCardSerialController::class,
        'kpi-target'    => KpiTargetController::class,
        'productType'   => ProductAndTypeController::class,
        'lifting'       => LiftingController::class,
    ]);

});


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
