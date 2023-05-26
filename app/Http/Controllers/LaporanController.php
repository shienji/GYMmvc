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

    public function data_user_filter(Request $request){
        $x = $request->query('x');
        $y = $request->query('y');
        $z = $request->query('z');
        $a = $request->query('a');

        // tidak filter
        if ($x=='-' && $y=='-' && $z=='-' && $a=='-') {
            $query_user_filter = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->get();
        // hanya filter role
        } else if ($x=='-' && $y!='-' && $z!='-' && $a=='-') {
            $query_user_filter = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->whereBetween('user.created_at', [$y, $z])
                ->get();
        // hanya filter tanggal
        } else if ($x!='-' && $y=='-' && $z=='-' && $a=='-') {
            $query_user_filter = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->where('user.user_role','=',$x)
                ->get();
        // hanya filter status
        } else if ($x=='-' && $y=='-' && $z=='-' && $a!='-') {
            $query_user_filter = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->where('user.user_status','=',$a)
                ->get();
        // filter semua
        } else {
            $query_user_filter = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->where('user.user_role','=',$x)
                ->whereBetween('user.created_at', [$y, $z])
                ->where('user.user_status','=',$a)
                ->get();
        }

        return DataTables::of($query_user_filter)->make(true);
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
