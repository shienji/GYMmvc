<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;

class MasterController extends Controller
{
    public function home_master()
    {
        return view('Master.Home_Master');
    }
    public function role_master()
    {
        $vjenis = DB::table('role')->select("role_id", "role_nama")->get();
        return view('Master.Role_Master')->with("vjenis", $vjenis);
    }
    public function getDataRole()
    {
        $data = DB::table("role")
            ->get();

        return $data;
    }

    public function role_masterpost(Request $r)
    {
        if ($r->role_id != "") {
            $cek1 = $r->validate([
                'nama' => 'required',
                'Harga' => 'required|min:1'
            ]);


            $cek3 = DB::table("role")->where("role_id", $r->role_id)
                ->update([
                    'role_nama' => $r->nama,
                    'role_harga' => $r->Harga,
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            return back()->with("success", "Data telah diubah");
        } else {
            $cek1 = $r->validate([
                'nama' => 'required',
                'Harga' => 'required|min:1'
            ]);

            $cek2 = DB::table("role")->insert(
                [
                    "role_nama" => $r->nama,
                    "role_harga" => $r->Harga,
                    "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    "role_status" => 'aktif',
                ]
            );

            // $cek3 = DB::table("user")->where("user_id", $r->user_id)
            //     ->update(['user_status' => 'Active']);

            return back()->with("success", "Data telah disimpan");
        }
    }

    public function role_masterdel(Request $r)
    {
        $status=DB::table("role")->select("role_status")->where("role_id",$r->role_id2)->first();

        if($status=="aktif"){
            return back()->with("success", "Data telah hapus");

        }
        else{
            // $cek3 = DB::table("role")->where("role_id", $r->role_id)
            // ->update([
            //     'role_nama' => $r->nama,
            //     'role_harga' => $r->Harga,
            //     "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            // ]);

        return back()->with("success", "Data telah restore");
        }


    }
    public function peralatan_master()
    {
        return view('Master.Peralatan_Master');
    }
    public function pelatih_master()
    {
        return view('Master.Pelatih_Master');
    }
    public function fasilitas_master()
    {
        return view('Master.Fasilitas_Master');
    }
}
