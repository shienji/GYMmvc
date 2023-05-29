<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\isAdmin;

Route::get('/', function () {return view('welcome');})->name('home');
Route::get('/contact', function () {return view('welcome');})->name('contact');

Route::prefix("/user")->group(function(){
    Route::get('/login', [LayoutController::class, 'loginPage'])->name("layout-loginpage");
    Route::get('/register', [LayoutController::class, 'registerPage'])->name("layout-registerpage");
});
//Route::get('posts', 'PostController@index')->middleware('admin');

Route::prefix("/transaksi")->group(function(){
    Route::get('/',[TransaksiController::class, 'viewDash'])->name("trans-vdashboard");
    Route::get('/member/get',[TransaksiController::class, 'getDataNewMember'])->name("trans-vdataregister");
    Route::get('/member/getrenewal',[TransaksiController::class, 'getDataRenewal'])->name("trans-vdatarenewal");
    Route::get('/member/getevent',[TransaksiController::class, 'getDataEvent'])->name("trans-vdataevent");

    Route::prefix("/register")->group(function(){
        Route::get('/',[TransaksiController::class, 'viewRegister'])->name("trans-vregister");
        Route::post('/save',[TransaksiController::class, 'viewRegisterSave'])->name("trans-vregsave");
    });
    Route::prefix("/renewal")->group(function(){
        Route::get('/',[TransaksiController::class, 'viewRenewal'])->name("trans-vrenewal");
        Route::post('/',[TransaksiController::class, 'viewRenewalSave'])->name("trans-vrensave");
        Route::delete('/del',[TransaksiController::class, 'viewRenewalDel'])->name("trans-vrendel");
        Route::get('/history',[TransaksiController::class, 'viewRenewalHis'])->name("trans-vrenhis");
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

    // Route::prefix("/laporan")->group(function(){
    //     Route::get('/register',[TransaksiController::class, 'lapRegister'])->name("trans-lregister");
    //     Route::get('/renewal',[TransaksiController::class, 'lapRenewal'])->name("trans-lrenewal");
    //     Route::get('/event',[TransaksiController::class, 'lapEvent'])->name("trans-levent");
    //     Route::get('/jual',[TransaksiController::class, 'lapJual'])->name("trans-ljual");
    // });
});

Route::prefix("/laporan")->group(function(){
    // Route::get('/',[LaporanController::class, 'dashboard'])->name("laporan");

    // USER
    Route::get('/user',[LaporanController::class, 'view_user'])->name("laporan-user");
    Route::get('/user/data',[LaporanController::class, 'data_user'])->name('data-user');

    // TRANSAKSI
    Route::get('/transaksi',[LaporanController::class, 'view_transaksi'])->name('laporan-transaksi');
    Route::get('/transaksi/data',[LaporanController::class, 'data_transaksi'])->name('data-transaksi');

    // FASILITAS
    Route::get('/fasilitas',[LaporanController::class, 'view_fasilitas'])->name('laporan-fasilitas');
    Route::get('/fasilitas/data',[LaporanController::class, 'data_fasilitas'])->name('data-fasilitas');

    // EVENT
    Route::get('/event',[LaporanController::class, 'view_event'])->name('laporan-event');
    Route::get('/event/data',[LaporanController::class, 'data_event'])->name('data-event');
});

Route::prefix("/Master")->group(function(){
    Route::get('/',[MasterController::class, 'home_master'])->name("home_master");
    Route::prefix("/Role")->group(function(){
        Route::get('/',[MasterController::class, 'role_master'])->name("role_master");
        Route::post('/',[MasterController::class, 'role_masterpost'])->name("role_masterpost");
        Route::post('/delete',[MasterController::class, 'role_masterdel'])->name("role_masterdel");
        Route::get('/get',[MasterController::class, 'getDataRole'])->name("getDataRole");
    });
    Route::prefix("/Peralatan")->group(function(){
        Route::get('/',[MasterController::class, 'peralatan_master'])->name("peralatan_master");
        Route::post('/',[MasterController::class, 'peralatan_masterpost'])->name("peralatan_masterpost");
        Route::post('/delete',[MasterController::class, 'peralatan_masterdel'])->name("peralatan_masterdel");
        Route::get('/get',[MasterController::class, 'getDataPeralatan'])->name("getDataPeralatan");
    });
    Route::prefix("/Pelatih")->group(function(){
        Route::get('/',[MasterController::class, 'pelatih_master'])->name("pelatih_master");
        Route::post('/',[MasterController::class, 'pelatih_masterpost'])->name("pelatih_masterpost");
        Route::post('/delete',[MasterController::class, 'pelatih_masterdel'])->name("pelatih_masterdel");
        Route::get('/get',[MasterController::class, 'getDataPelatih'])->name("getDataPelatih");
    });
    Route::prefix("/Fasilitas")->group(function(){
        Route::get('/',[MasterController::class, 'fasilitas_master'])->name("fasilitas_master");
        Route::post('/',[MasterController::class, 'fasilitas_masterpost'])->name("fasilitas_masterpost");
        Route::post('/delete',[MasterController::class, 'fasilitas_masterdel'])->name("fasilitas_masterdel");
        Route::get('/get',[MasterController::class, 'getDataFasilitas'])->name("getDataFasilitas");
    });
});
