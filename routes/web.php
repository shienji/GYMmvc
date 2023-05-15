<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/transaksi")->group(function(){
    Route::get('/',[TransaksiController::class, 'viewBayar'])->name("trans-vbayar");
    Route::get('/perpanjang',[TransaksiController::class, 'viewUpdate'])->name("trans-vupdate");
    Route::get('/event',[TransaksiController::class, 'viewEvent'])->name("trans-vevent");
    Route::get('/jual',[TransaksiController::class, 'viewJual'])->name("trans-vjual");
});