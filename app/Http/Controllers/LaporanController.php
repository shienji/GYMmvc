<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class LaporanController extends Controller
{
    public function dashboard(){
        return view('laporan.dashboard');
    }

    public function user(){
        $user = DB::table('user')->get();
    	return view('laporan.user',['user' => $user]);
    }
}
