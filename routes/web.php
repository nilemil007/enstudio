<?php

use App\Http\Controllers\DdHouseController;
use App\Http\Controllers\ItopReplaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RsoController;
use App\Http\Controllers\SupervisorController;
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
    });

    // Rso Additional Routes
    Route::prefix('/rso')->controller( RsoController::class )->name('rso.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // Route Additional Routes
    Route::prefix('/route')->controller( RouteController::class )->name('route.')->group(function (){
        // Delete all
        Route::post('/delete/all','deleteAll')->name('delete.all');
        // Import
        Route::post('/import','import')->name('import');
        // Download sample file
        Route::get('/sample-file-download','sampleFileDownload')->name('sample.file.download');
    });

    // Resource Routes
    Route::resources([
        'itop-replace'  => ItopReplaceController::class,
        'user'          => UserController::class,
        'dd-house'      => DdHouseController::class,
        'supervisor'    => SupervisorController::class,
        'rso'           => RsoController::class,
        'route'         => RouteController::class,
    ]);

});


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
