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

    public function user(){
        return DataTables::of(User::query())
        ->addColumn('action', function($model){
            return '<a href="'.route('edit', $model->id).'"><button class="btn btn-primary btn-sm">Edit</button></a>';
        })
        // ->make(true);
        ->toJson();
    }

    public function transaksi(){
        return DataTables::of(Transaksi::query())
        // ->addColumn('action', function($model){
        //     return '<a href="'.route('edit', $model->id).'"><button class="btn btn-primary btn-sm">Edit</button></a>';
        // })
        ->make(true);
        // ->toJson();
    }
}
