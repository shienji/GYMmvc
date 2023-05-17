<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/layout")->group(function(){
    Route::get('/login', [LayoutController::class, 'loginPage'])->name("layout-loginpage");
});

Route::prefix("/transaksi")->group(function(){
    Route::get('/',[TransaksiController::class, 'viewDash'])->name("trans-vdashboard");
    Route::prefix("/register")->group(function(){
        Route::get('/',[TransaksiController::class, 'viewRegister'])->name("trans-vregister");
        Route::post('/save',[TransaksiController::class, 'viewRegSave'])->name("trans-vregsave");
    });
    Route::prefix("/renewal")->group(function(){
        Route::get('/',[TransaksiController::class, 'viewRenewal'])->name("trans-vrenewal");
        Route::post('/',[TransaksiController::class, 'viewRenSave'])->name("trans-vrensave");
    });
    Route::prefix("/revent")->group(function(){
        Route::get('/',[TransaksiController::class, 'viewEvent'])->name("trans-vevent");
        Route::post('/save',[TransaksiController::class, 'viewEventSave'])->name("trans-veventsave");
    });
    Route::prefix("/jual")->group(function(){
        Route::get('/',[TransaksiController::class, 'viewJual'])->name("trans-vjual");
        Route::post('/save',[TransaksiController::class, 'viewJualSave'])->name("trans-vjualsave");
    });
    Route::get('/flow',[TransaksiController::class, 'viewFlow'])->name("trans-vflow");

    Route::prefix("/laporan")->group(function(){
        Route::get('/register',[TransaksiController::class, 'lapRegister'])->name("trans-lregister");
        Route::get('/renewal',[TransaksiController::class, 'lapRenewal'])->name("trans-lrenewal");
        Route::get('/event',[TransaksiController::class, 'lapEvent'])->name("trans-levent");
        Route::get('/jual',[TransaksiController::class, 'lapJual'])->name("trans-ljual");
    });
});

Route::prefix("/laporan")->group(function(){
    Route::get('/',[LaporanController::class, 'dashboard'])->name("laporan-dashboard");
    Route::get('/user',[LaporanController::class, 'user'])->name("laporan-user");
});


Route::prefix("/Master")->group(function(){
    Route::get('/',[MasterController::class, 'home_master'])->name("home_master");
    Route::prefix("/Role")->group(function(){
        Route::get('/',[MasterController::class, 'role_master'])->name("role_master");
        Route::post('/',[MasterController::class, 'role_masterpost'])->name("role_masterpost");
    });
    Route::prefix("/Peralatan")->group(function(){
        Route::get('/',[MasterController::class, 'peralatan_master'])->name("peralatan_master");
        Route::post('/',[MasterController::class, 'peralatan_masterpost'])->name("peralatan_masterpost");
    });
    Route::prefix("/Pelatih")->group(function(){
        Route::get('/',[MasterController::class, 'pelatih_master'])->name("pelatih_master");
        Route::post('/',[MasterController::class, 'pelatih_masterpost'])->name("pelatih_masterpost");
    });
    Route::prefix("/Fasilitas")->group(function(){
        Route::get('/',[MasterController::class, 'fasilitas_master'])->name("fasilitas_master");
        Route::post('/',[MasterController::class, 'fasilitas_masterpost'])->name("fasilitas_masterpost");
    });
});
