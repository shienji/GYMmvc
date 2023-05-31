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
    public function role_master_list()
    {
        $vjenis = DB::table('role')->get();
        return view('Master.Role_Master_list')->with("vjenis", $vjenis);
    }
    public function getDataRole($id)
    {
        $vjenisedit = DB::table("role")->where("role_id",$id)->first();
        return view('Master.Role_Master_edit')->with("vjenisedit", $vjenisedit);
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
            return view('Master.Role_Master')->with("success", "Data telah diubah");
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

    public function role_masterdel($id)
    {
        $status=DB::table("role")->where("role_id",$id)->first();

        if($status->role_status=="aktif"){
            $cek3 = DB::table("role")->where("role_id", $id)
            ->update([
                'role_status' => 'Non Aktif',
                "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return back()->with("success", "Data telah hapus");

        }
        else{
            $cek3 = DB::table("role")->where("role_id", $id)
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
        $vjenis=DB::table('fasilitas')->where("deleted_at",null)->get();
        return view('Master.Peralatan_Master')->with("vjenis",$vjenis);
    }
    public function getDataPeralatan()
    {
        $data = DB::table("peralatan")->get();

        return $data;
    }
    public function peralatan_masterpost(Request $r)
    {
        if ($r->peralatan_id != "") {
            $cek1 = $r->validate([
                'nama' => 'required',
                'fasilitas_nama' => 'required'
            ]);


            $cek3 = DB::table("peralatan")->where("peralatan_id", $r->peralatan_id)
                ->update([
                    'peralatan_nama' => $r->nama,
                    'fasilitas_nama' => $r->fasilitas_nama,
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            return back()->with("success", "Data telah diubah");
        } else {
            $cek1 = $r->validate([
                'nama' => 'required',
                'fasilitas_nama' => 'required'
            ]);

            $cek2 = DB::table("peralatan")->insert(
                [
                    "peralatan_nama" => $r->nama,
                    "fasilitas_nama" => $r->fasilitas_nama,
                    "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    "peralatan_status" => 'aktif',
                ]
            );



            return back()->with("success", "Data telah disimpan");
        }
    }
    public function peralatan_masterdel(Request $r)
    {
        $status=DB::table("peralatan")->where("peralatan_id",$r->peralatan_id2)->first();

        if($status->peralatan_status=="aktif"){
            $cek3 = DB::table("peralatan")->where("peralatan_id", $r->peralatan_id2)
            ->update([
                'peralatan_status' => 'Non Aktif',
                "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return back()->with("success", "Data telah hapus");

        }
        else{
            $cek3 = DB::table("peralatan")->where("peralatan_id", $r->peralatan_id2)
            ->update([
                'peralatan_status' => 'aktif',
                "deleted_at" => null,
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        return back()->with("success", "Data telah restore");
        }


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
                'pelatih_status' => 'aktif',
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
    public function fasilitas_master_list()
    {
        $vjenis = DB::table('fasilitas')->get();
        return view('Master.Fasilitas_Master_list')->with("vjenis", $vjenis);
    }

    public function getDataFasilitas($id)
    {$vjenisedit = DB::table("fasilitas")->where("fasilitas_id",$id)->first();
        return view('Master.Fasilitas_Master_edit')->with("vjenisedit", $vjenisedit);
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
                return view('Master.Fasilitas_Master')->with("success", "Data telah diubah");
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

    public function fasilitas_masterdel($id)
    {
        $status=DB::table("fasilitas")->where("fasilitas_id",$id)->first();

        if($status->fasilitas_status=="aktif"){
            $cek3 = DB::table("fasilitas")->where("fasilitas_id", $id)
            ->update([
                'fasilitas_status' => 'Non Aktif',
                "deleted_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return back()->with("success", "Data telah hapus");

        }
        else{
            $cek3 = DB::table("fasilitas")->where("fasilitas_id", $id)
            ->update([
                'fasilitas_status' => 'aktif',
                "deleted_at" => null,
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        return back()->with("success", "Data telah restore");
        }


    }

}
