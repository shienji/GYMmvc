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



            return back()->with("success", "Data telah disimpan");
        }
    }

    public function role_masterdel(Request $r)
    {
        $status=DB::table("role")->where("role_id",$r->role_id2)->first();

        if($status->role_status=="aktif"){
            $cek3 = DB::table("role")->where("role_id", $r->role_id2)
            ->update([
                'role_status' => 'Non Aktif',
                "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return back()->with("success", "Data telah hapus");

        }
        else{
            $cek3 = DB::table("role")->where("role_id", $r->role_id2)
            ->update([
                'role_status' => 'aktif',
                "deleted_at" => null,
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        return back()->with("success", "Data telah restore");
        }


    }





    public function peralatan_master()
    {
        return view('Master.Peralatan_Master');
    }






    public function pelatih_master()
    {
        $vjenis = DB::table('pelatih')->get();
        return view('Master.Pelatih_Master')->with("vjenis", $vjenis);
    }

    public function getDataPelatih()
    {
        $data = DB::table("pelatih")
            ->get();

        return $data;
    }
      public function pelatih_masterpost(Request $r)
    {
        if ($r->pelatih_id != "") {
            $cek1 = $r->validate([
                'nama' => 'required',
                'nik' => 'required|min:1',
                'keahlian' => 'required'
            ]);


            $cek3 = DB::table("pelatih")->where("pelatih_id", $r->pelatih_id)
                ->update([
                    'pelatih_nama' => $r->nama,
                    'pelatih_nik' => $r->nik,
                    'pelatih_keahlian' => $r->keahlian,
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            return back()->with("success", "Data telah diubah");
        } else {
            $cek1 = $r->validate([
                'nama' => 'required',
                'nik' => 'required|min:1',
                'keahlian' => 'required'
            ]);

            $cek2 = DB::table("pelatih")->insert(
                [
                    'pelatih_nama' => $r->nama,
                    'pelatih_nik' => $r->nik,
                    'pelatih_keahlian' => $r->keahlian,
                    "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    "pelatih_status" => 'aktif',
                ]
            );

            return back()->with("success", "Data telah disimpan");
        }
    }
    public function pelatih_masterdel(Request $r)
    {
        $status=DB::table("pelatih")->where("pelatih_id",$r->pelatih_id2)->first();

        if($status->pelatih_status=="aktif"){
            $cek3 = DB::table("pelatih")->where("pelatih_id", $r->pelatih_id2)
            ->update([
                'pelatih_status' => 'Non Aktif',
                "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return back()->with("success", "Data telah hapus");

        }
        else{
            $cek3 = DB::table("pelatih")->where("pelatih_id", $r->pelatih_id2)
            ->update([
                'pelatih_status' => 'Aktif',
                "deleted_at" => null,
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        return back()->with("success", "Data telah restore");
        }


    }







    public function fasilitas_master()
    {
        $vjenis = DB::table('fasilitas')->select("fasilitas_id", "fasilitas_nama")->get();
        return view('Master.Fasilitas_Master')->with("vjenis", $vjenis);
    }

    public function getDataFasilitas()
    {
        $data = DB::table("fasilitas")
            ->get();

        return $data;
    }

    public function fasilitas_masterpost(Request $r)
    {
        if ($r->fasilitas_id != "") {
            $cek1 = $r->validate([
                'nama' => 'required',

            ]);


            $cek3 = DB::table("fasilitas")->where("fasilitas_id", $r->fasilitas_id)
                ->update([
                    'fasilitas_nama' => $r->nama,
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            return back()->with("success", "Data telah diubah");
        } else {
            $cek1 = $r->validate([
                'nama' => 'required',
            ]);

            $cek2 = DB::table("fasilitas")->insert(
                [
                    "fasilitas_nama" => $r->nama,
                    "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    "fasilitas_status" => 'aktif',
                ]
            );



            return back()->with("success", "Data telah disimpan");
        }
    }

    public function fasilitas_masterdel(Request $r)
    {
        $status=DB::table("fasilitas")->where("fasilitas_id",$r->fasilitas_id2)->first();

        if($status->fasilitas_status=="aktif"){
            $cek3 = DB::table("fasilitas")->where("fasilitas_id", $r->fasilitas_id2)
            ->update([
                'fasilitas_status' => 'Non Aktif',
                "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return back()->with("success", "Data telah hapus");

        }
        else{
            $cek3 = DB::table("fasilitas")->where("fasilitas_id", $r->fasilitas_id2)
            ->update([
                'fasilitas_status' => 'aktif',
                "deleted_at" => null,
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        return back()->with("success", "Data telah restore");
        }


    }

}
