<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function viewDash(){
        return view('transaksi.dashboard');
    }
    public function viewRegister(){
        return view('transaksi.register');
    }
    public function viewRenewal(){
        return view('transaksi.renewal');
    }
    public function viewEvent(){
        return view('transaksi.event');
    }
    public function viewJual(){
        return view('transaksi.jual');
    }


    public function lapRegister(){
        return view('transaksi.register');
    }
    public function lapRenewal(){
        return view('transaksi.renewal');
    }
    public function lapEvent(){
        return view('transaksi.event');
    }
    public function lapJual(){
        return view('transaksi.jual');
    }
}
