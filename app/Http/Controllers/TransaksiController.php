<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function viewBayar(){
        return view('transaksi.bayarAnggota');
    }
}
