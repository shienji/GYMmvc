<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transaksi extends Controller
{
    public function viewBayar(){
        return view("transaksi.bayarAnggota");
    }
}
