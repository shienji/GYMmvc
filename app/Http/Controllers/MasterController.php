<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterController extends Controller
{
    public function home_master(){
        return view('Master.Home_Master');
    }
    public function role_master(){
        $vjenis=DB::table('role')->select("role_id","role_nama")->get();
        return view('Master.Role_Master')->with("vjenis",$vjenis);
    }
    public function getDataRole(){
        $data=DB::table("role")
        ->get();

        return $data;
    }
    public function peralatan_master(){
        return view('Master.Peralatan_Master');
    }
    public function pelatih_master(){
        return view('Master.Pelatih_Master');
    }
    public function fasilitas_master(){
        return view('Master.Fasilitas_Master');
    }
}
