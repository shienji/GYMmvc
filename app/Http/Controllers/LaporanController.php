<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function dashboard(){
        return view('laporan.dashboard');
    }

    // USER
    public function view_user()
    {
        return view('laporan.user');
    }

    public function data_user(){
        $query_user = DB::table('user')->join('role','role.role_nama','=','user.user_role')->get();

        return DataTables::of($query_user)->make(true);
    }

    // TRANSAKSI
    public function view_transaksi()
    {
        return view('laporan.transaksi');
    }

    public function data_transaksi(){
        $query_transaksi = DB::table('transaksi')->join('user','user.user_id','=','transaksi.user_id')->get();

        return DataTables::of($query_transaksi)->make(true);
    }

    // FASILITAS
    public function view_fasilitas()
    {
        return view('laporan.fasilitas');
    }

    public function data_fasilitas(){
        $query_fasilitas = DB::table('fasilitas')->get();

        return DataTables::of($query_fasilitas)->make(true);
    }

    // EVENT
    public function view_event()
    {
        return view('laporan.event');
    }

    public function data_event(){
        $query_event = DB::table('event')->get();

        return DataTables::of($query_event)->make(true);
    }
}
