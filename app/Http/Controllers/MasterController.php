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

    public function role_masterpost(Request $r){
        $cek1=$r->validate([
            'user_id' => 'required|numeric|min:1',
            'role' => 'required'
        ]);
        $vharga=DB::table("role")->where("deleted_at",null)->where("role_nama",$r->role)->first();
        $cek2=DB::table("transaksi")->insert(
            ["user_id"=>$r->user_id,
            "transaksi_daftar"=>Carbon::now()->format('Y-m-d H:i:s'),
            "transaksi_expired"=>Carbon::createFromFormat('Y-m-d H:i:s', $r->tglexpired." ".date('H:i:s') ),
            "transaksi_role"=>$r->role,
            "transaksi_harga"=>$vharga->role_harga
        ]);

        $cek3=DB::table("user")->where("user_id",$r->user_id)
        ->update(['user_status' => 'Active']);

        return back()->with("success","Data telah disimpan");
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
