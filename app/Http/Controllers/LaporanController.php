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
        $query_chart = 'SELECT COUNT(*) AS "hasil" FROM user WHERE user_role="admin"
            UNION ALL
            SELECT COUNT(*) AS "hasil" FROM user WHERE user_role="BRONZE"
            UNION ALL
            SELECT COUNT(*) AS "hasil" FROM user WHERE user_role="SILVER"
            UNION ALL
            SELECT COUNT(*) AS "hasil" FROM user WHERE user_role="GOLD"
        ';

        $data = DB::select($query_chart);
        $dataChart = [];
        foreach ($data as $row) {
            $dataChart[] = $row->hasil;
        }

        // dd($dataChart);
        return view('laporan.user', compact('dataChart'));
    }

    public function data_user(Request $request)
    {
        $x = $request->query('x');
        $y = $request->query('y');
        $z = $request->query('z');
        $a = $request->query('a');

        // user tanpa filter
        if ($x == '-' && $y == '-' && $z == '-' && $a == '-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->get();
            // user filter tanggal
        } else if ($x == '-' && $y != '-' && $z != '-' && $a == '-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->whereBetween('user.created_at', [$y, $z])
                ->get();
            // user filter role
        } else if ($x != '-' && $y == '-' && $z == '-' && $a == '-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->where('user.user_role', '=', $x)
                ->get();
            // user filter status
        } else if ($x == '-' && $y == '-' && $z == '-' && $a != '-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->where('user.user_status', '=', $a)
                ->get();
            // user filter role & status
        } else if ($x != '-' && $y == '-' && $z == '-' && $a != '-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->where('user.user_role', '=', $x)
                ->where('user.user_status', '=', $a)
                ->get();
            // user filter role & tanggal
        } else if ($x != '-' && $y != '-' && $z != '-' && $a == '-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->where('user.user_role', '=', $x)
                ->whereBetween('user.created_at', [$y, $z])
                ->get();
            // user filter tanggal & status
        } else if ($x == '-' && $y != '-' && $z != '-' && $a != '-') {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->whereBetween('user.created_at', [$y, $z])
                ->where('user.user_status', '=', $a)
                ->get();
            // user filter semua
        } else {
            $query_user = DB::table('user')
                ->select('*', DB::raw("DATE_FORMAT(user.created_at, '%d-%m-%Y') AS created_at"))
                ->join('role', 'role.role_nama', '=', 'user.user_role')
                ->where('user.user_role', '=', $x)
                ->whereBetween('user.created_at', [$y, $z])
                ->where('user.user_status', '=', $a)
                ->get();
        }

        return DataTables::of($query_user)->make(true);
    }

    // TRANSAKSI
    public function view_transaksi()
    {
        // return view('laporan.transaksi');
        $query_daftar = 'SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-01-01 00:00:00" AND "2023-01-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-02-01 00:00:00" AND "2023-02-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-03-01 00:00:00" AND "2023-03-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-04-01 00:00:00" AND "2023-04-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-05-01 00:00:00" AND "2023-05-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-06-01 00:00:00" AND "2023-06-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-07-01 00:00:00" AND "2023-07-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-08-01 00:00:00" AND "2023-08-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-09-01 00:00:00" AND "2023-09-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-10-01 00:00:00" AND "2023-10-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-11-01 00:00:00" AND "2023-11-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "daftar" FROM transaksi WHERE transaksi_daftar BETWEEN "2023-12-01 00:00:00" AND "2023-12-28 23:00:00"
        ';

        $dataDaftar = DB::select($query_daftar);
        $arrayDaftar = [];
        foreach ($dataDaftar as $row) {
            $arrayDaftar[] = $row->daftar;
        }

        $query_expired = 'SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-01-01 00:00:00" AND "2023-01-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-02-01 00:00:00" AND "2023-02-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-03-01 00:00:00" AND "2023-03-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-04-01 00:00:00" AND "2023-04-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-05-01 00:00:00" AND "2023-05-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-06-01 00:00:00" AND "2023-06-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-07-01 00:00:00" AND "2023-07-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-08-01 00:00:00" AND "2023-08-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-09-01 00:00:00" AND "2023-09-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-10-01 00:00:00" AND "2023-10-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-11-01 00:00:00" AND "2023-11-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "expired" FROM transaksi WHERE transaksi_expired BETWEEN "2023-12-01 00:00:00" AND "2023-12-28 23:00:00"
        ';

        $dataExpired = DB::select($query_expired);
        $arrayExpired = [];
        foreach ($dataExpired as $row) {
            $arrayExpired[] = $row->expired;
        }

        $dataTotal = DB::table('transaksi')->sum('transaksi_harga');

        // dd($dataChart);
        return view('laporan.transaksi', compact('arrayDaftar', 'arrayExpired', 'dataTotal'));
    }

    public function data_transaksi(Request $request)
    {
        $x = $request->query('x');
        $y = $request->query('y');
        $z = $request->query('z');
        $a = $request->query('a');
        $b = $request->query('b');

        // transaksi tanpa filter
        if ($x == '-' && $y == '-' && $z == '-' && $a == '-' && $b == '-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->get();
            // transaksi filter daftar
        } else if ($x != '-' && $y != '-' && $z == '-' && $a == '-' && $b == '-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->get();
            // transaksi filter expired
        } else if ($x == '-' && $y == '-' && $z != '-' && $a != '-' && $b == '-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->get();
            // transaksi filter role
        } else if ($x == '-' && $y == '-' && $z == '-' && $a == '-' && $b != '-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->where('transaksi.transaksi_role', '=', $b)
                ->get();
            // transaksi filter daftar & expired
        } else if ($x != '-' && $y != '-' && $z != '-' && $a != '-' && $b == '-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->get();
            // transaksi filter daftar & role
        } else if ($x != '-' && $y != '-' && $z == '-' && $a == '-' && $b == '-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->where('transaksi.transaksi_role', '=', $b)
                ->get();
            // transaksi filter expired & role
        } else if ($x == '-' && $y == '-' && $z != '-' && $a != '-' && $b != '-') {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->where('transaksi.transaksi_role', '=', $b)
                ->get();
            // transaksi tanpa filter
        } else {
            $query_transaksi = DB::table('transaksi')
                ->select('transaksi.*', DB::raw("DATE_FORMAT(transaksi.transaksi_daftar, '%d-%m-%Y') AS transaksi_daftar"), DB::raw("DATE_FORMAT(transaksi.transaksi_expired, '%d-%m-%Y') AS transaksi_expired"), 'user.user_nama', 'role.role_nama')
                ->join('role', 'role.role_nama', '=', 'transaksi.transaksi_role')
                ->join('user', 'user.user_id', '=', 'transaksi.user_id')
                ->whereBetween('transaksi.transaksi_daftar', [$x, $y])
                ->whereBetween('transaksi.transaksi_expired', [$z, $a])
                ->where('transaksi.transaksi_role', '=', $b)
                ->get();
        }

        return DataTables::of($query_transaksi)->make(true);
    }

    // FASILITAS
    public function view_fasilitas()
    {
        return view('laporan.fasilitas');
    }

    public function data_fasilitas(Request $request)
    {
        $x = $request->query('x');

        // fasilitas tanpa filter
        if ($x == '-') {
            $query_fasilitas = DB::table('fasilitas')
                ->get();
            // fasilitas filter status
        } else {
            $query_fasilitas = DB::table('fasilitas')
                ->where('fasilitas_status', '=', [$x])
                ->get();
        }

        return DataTables::of($query_fasilitas)->make(true);
    }

    // EVENT
    public function view_event()
    {
        // return view('laporan.event');
        $query_start = 'SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-01-01 00:00:00" AND "2023-01-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-02-01 00:00:00" AND "2023-02-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-03-01 00:00:00" AND "2023-03-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-04-01 00:00:00" AND "2023-04-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-05-01 00:00:00" AND "2023-05-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-06-01 00:00:00" AND "2023-06-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-07-01 00:00:00" AND "2023-07-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-08-01 00:00:00" AND "2023-08-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-09-01 00:00:00" AND "2023-09-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-10-01 00:00:00" AND "2023-10-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-11-01 00:00:00" AND "2023-11-28 23:00:00"
            UNION ALL
            SELECT COUNT(*) AS "start" FROM event WHERE event_start BETWEEN "2023-12-01 00:00:00" AND "2023-12-28 23:00:00"
        ';

        $dataStart = DB::select($query_start);
        $arrayStart = [];
        foreach ($dataStart as $row) {
            $arrayStart[] = $row->start;
        }

        // dd($dataChart);
        return view('laporan.event', compact('arrayStart'));
    }

    public function data_event(Request $request)
    {
        $x = $request->query('x');
        $y = $request->query('y');
        $z = $request->query('z');
        $a = $request->query('a');

        // event tanpa filter
        if ($x == '-' && $y == '-' && $z == '-' && $a == '-') {
            $query_event = DB::table('event')
                ->select('event.event_id', 'event.event_nama', 'fasilitas.fasilitas_nama', DB::raw("DATE_FORMAT(event.event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event.event_end, '%d-%m-%Y') AS event_end"))
                ->leftJoin('eventfas', 'eventfas.event_id', '=', 'event.event_id')
                ->leftJoin('fasilitas', 'fasilitas.fasilitas_id', '=', 'eventfas.fasilitas_id')
                ->get();
            // event filter tanggal mulai
        } else if ($x != '-' && $y != '-' && $z == '-' && $a == '-') {
            $query_event = DB::table('event')
                ->select('event.event_id', 'event.event_nama', 'fasilitas.fasilitas_nama', DB::raw("DATE_FORMAT(event.event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event.event_end, '%d-%m-%Y') AS event_end"))
                ->leftJoin('eventfas', 'eventfas.event_id', '=', 'event.event_id')
                ->leftJoin('fasilitas', 'fasilitas.fasilitas_id', '=', 'eventfas.fasilitas_id')
                ->whereBetween('event_start', [$x, $y])
                ->get();
            // event filter tanggal berakhir
        } else if ($x == '-' && $y == '-' && $z != '-' && $a != '-') {
            $query_event = DB::table('event')
                ->select('*', DB::raw("DATE_FORMAT(event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event_end, '%d-%m-%Y') AS event_end"))
                ->leftJoin('eventfas', 'eventfas.event_id', '=', 'event.event_id')
                ->leftJoin('fasilitas', 'fasilitas.fasilitas_id', '=', 'eventfas.fasilitas_id')
                ->whereBetween('event_end', [$z, $a])
                ->get();
            // event filter semua
        } else {
            $query_event = DB::table('event')
                ->select('*', DB::raw("DATE_FORMAT(event_start, '%d-%m-%Y') AS event_start"), DB::raw("DATE_FORMAT(event_end, '%d-%m-%Y') AS event_end"))
                ->leftJoin('eventfas', 'eventfas.event_id', '=', 'event.event_id')
                ->leftJoin('fasilitas', 'fasilitas.fasilitas_id', '=', 'eventfas.fasilitas_id')
                ->whereBetween('event_start', [$x, $y])
                ->whereBetween('event_end', [$z, $a])
                ->get();
        }

        return DataTables::of($query_event)->make(true);
    }
}
