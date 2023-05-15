<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
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