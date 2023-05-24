<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function viewDash(){
        return view('transaksi.dashboard');
    }

    // Register
    public function viewRegister(){
        $vjenis=DB::table('role')->select("role_id","role_nama","role_harga")->where("deleted_at",null)->get();
        return view('transaksi.register')->with("vjenis",$vjenis);
    }
    public function getDataNewMember(){
        $data=DB::table("user")->where("user_status","Process")        
        ->get();

        return $data;
    }
    public function viewRegisterSave(Request $r){        
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
    // Renewal
    public function viewRenewal(){
        $vjenis=DB::table('role')->select("role_id","role_nama")->where("deleted_at",null)->get();
        return view('transaksi.renewal')->with("vjenis",$vjenis);
    }
    public function getDataRenewal(){
        $data=DB::select("select a.*,
        (select transaksi_daftar from transaksi t where t.deleted_at is null and t.user_id=a.user_id order by t.transaksi_id desc limit 1 ) as transaksi_daftar,
        (select transaksi_expired from transaksi t where t.deleted_at is null and t.user_id=a.user_id order by t.transaksi_id desc limit 1 ) as transaksi_expired,
        (select transaksi_id from transaksi t where t.deleted_at is null and t.user_id=a.user_id order by t.transaksi_id desc limit 1 ) as transaksi_id
        from user as a 
        where a.deleted_at is null and a.user_role !='Admin' and a.user_status !='Process' ");

        return $data;
    }
    public function viewRenewalSave(Request $r){
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
    public function viewRenewalDel($trans_id){
        if($trans_id){
            if($trans_id>0){
                $cek1=DB::table("transaksi")->where("transaksi_id",$trans_id)
                ->delete();

                return back()->with("success","Data telah diHAPUS");
            }
        }
    }
    // Event
    public function viewEvent(){
        $data=DB::table('event')
        ->where("deleted_at",null)
        ->get();
        return view('transaksi.event')->with('vevent',$data);
    }

    // Penjualan (Cafe)
    public function viewJual(){
        return view('transaksi.jual');
    }

    // temporary
    public function lapRegister(){
        return view('transaksi.register');
    }
    public function lapRenewal(){
        return view('transaksi.renewal');
    }
    public function lapEvent(){
        return view('transaksi.event');
    }
    public function lapJual(){
        return view('transaksi.jual');
    }
}
