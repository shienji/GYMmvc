<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    // USER
    public function view_user()
    {
        return view('laporan.user');
    }

    public function data_user(Request $request){
        $x = $request->query('x');
        $y = $request->query('y');
        $z = $request->query('z');
        $a = $request->query('a');

        // tidak filter
        if ($x=='-' && $y=='-' && $z=='-' && $a=='-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->get();
        // hanya filter tanggal
        } else if ($x=='-' && $y!='-' && $z!='-' && $a=='-') {
            $query_user = DB::table('user')
            ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
            ->join('role','role.role_nama','=','user.user_role')
            ->whereBetween('user.created_at', [$y, $z])
            ->get();
        // hanya filter role
        } else if ($x!='-' && $y=='-' && $z=='-' && $a=='-') {
        $query_user = DB::table('user')
            ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
            ->join('role','role.role_nama','=','user.user_role')
            ->where('user.user_role','=',$x)
            ->get();
        // hanya filter status
        } else if ($x=='-' && $y=='-' && $z=='-' && $a!='-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->where('user.user_status','=',$a)
                ->get();
        // filter role & status
        } else if ($x!='-' && $y=='-' && $z=='-' && $a!='-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->where('user.user_role','=',$x)
                ->where('user.user_status','=',$a)
                ->get();
        // filter role & tanggal
        } else if ($x!='-' && $y!='-' && $z!='-' && $a=='-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->where('user.user_role','=',$x)
                ->whereBetween('user.created_at', [$y, $z])
                ->get();
        // filter tanggal & status
        } else if ($x=='-' && $y!='-' && $z!='-' && $a!='-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->whereBetween('user.created_at', [$y, $z])
                ->where('user.user_status','=',$a)
                ->get();
        // filter semua
        } else {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role','role.role_nama','=','user.user_role')
                ->where('user.user_role','=',$x)
                ->whereBetween('user.created_at', [$y, $z])
                ->where('user.user_status','=',$a)
                ->get();
        }

        return DataTables::of($query_user)->make(true);
    }

    // TRANSAKSI
    public function view_transaksi()
    {
        return view('laporan.transaksi');
    }

    public function data_transaksi(Request $request){
        $x = $request->query('x');
        $y = $request->query('y');
        $z = $request->query('z');
        $a = $request->query('a');
        $b = $request->query('b');

        // tanpa filter
        if ($x=='-' && $y=='-' && $z=='-' && $a=='-' && $b=='-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->get();
        // filter daftar
        } else if ($x!='-' && $y!='-' && $z=='-' && $a=='-' && $b=='-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->get();
        // filter expired
        } else if ($x=='-' && $y=='-' && $z!='-' && $a!='-' && $b=='-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->get();
        // filter role
        } else if ($x=='-' && $y=='-' && $z=='-' && $a=='-' && $b!='-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->where('transaksi.transaksi_role','=',$b)
                ->get();
        // filter daftar & expired
        } else if ($x!='-' && $y!='-' && $z!='-' && $a!='-' && $b=='-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->get();
        // filter daftar & role
        } else if ($x!='-' && $y!='-' && $z=='-' && $a=='-' && $b=='-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->where('transaksi.transaksi_role','=',$b)
                ->get();
        // filter expired & role
        } else if ($x=='-' && $y=='-' && $z!='-' && $a!='-' && $b!='-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->where('transaksi.transaksi_role','=',$b)
                ->get();
        // tanpa filter
        } else {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role','role.role_id','=','transaksi.transaksi_role')
                ->join('user','user.user_id','=','transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->where('transaksi.transaksi_role','=',$b)
                ->get();
        }

        return DataTables::of($query_transaksi)->make(true);
    }

    // FASILITAS
    public function view_fasilitas()
    {
        return view('laporan.fasilitas');
    }

    public function data_fasilitas(Request $request){
        $x = $request->query('x');

        //tanpa filter
        if ($x == '-') {
            $query_fasilitas = DB::table('fasilitas')
                ->get();
        // filter status
        } else {
            $query_fasilitas = DB::table('fasilitas')
                ->where('fasilitas_status','=',[$x])
                ->get();
        }

        return DataTables::of($query_fasilitas)->make(true);
    }

    // EVENT
    public function view_event()
    {
        return view('laporan.event');
    }

    public function data_event(Request $request){
        $x = $request->query('x');
        $y = $request->query('y');
        $z = $request->query('z');
        $a = $request->query('a');

        //tanpa filter
        if ($x == '-' && $y == '-' && $z == '-' && $a == '-') {
            $query_event = DB::table('event')
                ->select('*', DB::raw("DATE_FORMAT(event.event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event.event_end, '%d-%m-%Y') AS event_end"))
                ->get();
        // filter tanggal mulai
        } else if ($x != '-' && $y != '-' && $z == '-' && $a == '-') {
            $query_event = DB::table('event')
                ->select('*', DB::raw("DATE_FORMAT(event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event_end, '%d-%m-%Y') AS event_end"))
                ->whereBetween('event_start', [$x, $y])
                ->get();
        // filter tanggal berakhir
        } else if ($x == '-' && $y == '-' && $z != '-' && $a != '-') {
            $query_event = DB::table('event')
                ->select('*', DB::raw("DATE_FORMAT(event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event_end, '%d-%m-%Y') AS event_end"))
                ->whereBetween('event_end', [$z, $a])
                ->get();
        // filter semua
        } else {
            $query_event = DB::table('event')
                ->select('*', DB::raw("DATE_FORMAT(event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event_end, '%d-%m-%Y') AS event_end"))
                ->whereBetween('event_start', [$x, $y])
                ->whereBetween('event_end', [$z, $a])
                ->get();
        }

        return DataTables::of($query_event)->make(true);
    }
}
