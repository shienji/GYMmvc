<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function viewDash(){
        return view('transaksi.dashboard');
    }
    public function viewRegister(){
        $vjenis=DB::table('role')->select("role_id","role_nama")->get();
        return view('transaksi.register')->with("vjenis",$vjenis);
    }
    public function getDataNewMember(){
        $data=DB::table("user")->where("user_status","Process")        
        ->get();

        return $data;
    }
    public function getDataRenewal(){
        $data=DB::table("user")
        ->leftjoin("transaksi as t","t.user_id","user.user_id")
        ->where("user.user_status","!=","Process")
        ->select("user.*","t.transaksi_daftar","t.transaksi_expired")
        ->get();

        return $data;
    }
    public function viewRenewal(){
        $vjenis=DB::table('role')->select("role_id","role_nama")->get();        
        return view('transaksi.renewal')->with("vjenis",$vjenis);
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
