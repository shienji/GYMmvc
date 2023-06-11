<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function viewDash(){
        // return view('transaksi.dashboard');
        return redirect()->route('trans-vregister');
    }
    public function uploadFile(Request $r){
        $_FILES["buktiimg"];
        
    }
    
    public function cekPage(){
        return view('transaksi.cek');
    }

    // User event
    
    public function viewLoginEvent(){
        // $vjenis=DB::table('role')->select("role_id","role_nama","role_harga")->where("deleted_at",null)->get();
        $vevent=DB::table('event')->where("deleted_at",null)->where("event_end",">=",Carbon::now())->get();
        $vmember=DB::table('user')->where("user_status","Active")->where("user_role","!=","Admin")->get();
        return view('transaksi.userevent')->with("vevent",$vevent)->with('vmember',$vmember);
    }

    // Register
    public function viewRegister(){
        $vjenis=DB::table('role')->select("role_id","role_nama","role_harga")->where("deleted_at",null)->get();
        return view('transaksi.register')->with("vjenis",$vjenis);
    }
    public function getDataNewMember(){
        $data=DB::table("user")->where("deleted_at",null)->where("user_status","Process")
        ->get();

        return $data;
    }
    public function viewRegisterSave(Request $r){
        $cek1=$r->validate([
            'user_id' => 'required|numeric|min:1',
            'role' => 'required',
            'tglexpired' => 'required',
            'jmlbulan' => 'required'
        ]);
        $tglsekarang=Carbon::now()->format('Y-m-d H:i:s');
        $vharga=DB::table("role")->where("deleted_at",null)->where("role_nama",$r->role)->first();
        
        $cek2=DB::table("transaksi")->insertGetId(
            ["user_id"=>$r->user_id,
            "transaksi_daftar"=>$tglsekarang,
            "transaksi_expired"=>Carbon::createFromFormat('Y-m-d H:i:s', $r->tglexpired." ".date('H:i:s') ),
            "transaksi_role"=>$r->role,
            "transaksi_harga"=>$vharga->role_harga,
            "transaksi_bulan"=>$r->jmlbulan,
        ]);
        $bukti1="";$bukti2="";$bukti3="";
        if ($r->hasFile('buktiimg')) {
            $files = $r->file('buktiimg');
            $count = count($files);
            
            foreach ($files as $index => $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $newName = $cek2."_".$originalName;

                $path = $file->storeAs('public/upload', $newName);
                ${'bukti' . ($index + 1)} = $newName;
            }
        }
        
        $cek3=DB::table("transaksi")->where("transaksi_id",$cek2)
        ->update(['transaksi_bukti1' => $bukti1,'transaksi_bukti2' => $bukti2,'transaksi_bukti3' => $bukti3]);

        $cek3=DB::table("user")->where("user_id",$r->user_id)
        ->update(['user_status' => 'Active',"created_at"=>$tglsekarang]);

        return back()->with("success","Data telah disimpan");
        // return redirect()->route('trans-cekpage');
    }

    // Renewal
    public function viewRenewal(){
        $vjenis=DB::table('role')->select("role_id","role_nama","role_harga")->where("deleted_at",null)->get();
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
    public function viewRenewalHis(Request $r){
        $cek1=$r->validate([
            'user_id' => 'required',
        ]);

        $data=DB::table('transaksi as t')
        ->where('t.deleted_at',null)
        ->where('t.user_id',$r->user_id)
        ->orderby('t.transaksi_id','desc')
        ->get();

        return $data;
    }
    public function viewRenewalEvent(Request $r){
        $cek1=$r->validate([
            'user_id' => 'required',
        ]);

        $data=(object)[];
        return $data;
    }
    public function viewRenewalSave(Request $r){
        $cek1=$r->validate([
            'user_id' => 'required|numeric|min:1',
            'role' => 'required',
            'tglexpired' => 'required',
            'jmlbulan' => 'required'
        ]);

        $vharga=DB::table("role")->where("deleted_at",null)->where("role_nama",$r->role)->first();
        $cek2=DB::table("transaksi")->insertGetId(
            ["user_id"=>$r->user_id,
            "transaksi_daftar"=>Carbon::now()->format('Y-m-d H:i:s'),
            "transaksi_expired"=>Carbon::createFromFormat('Y-m-d H:i:s', $r->tglexpired." ".date('H:i:s') ),
            "transaksi_role"=>$r->role,
            "transaksi_harga"=>$vharga->role_harga,
            "transaksi_bulan"=>$r->jmlbulan
        ]);

        $bukti1="";$bukti2="";$bukti3="";
        if ($r->hasFile('buktiimg')) {
            $files = $r->file('buktiimg');
            $count = count($files);
            
            foreach ($files as $index => $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $newName = $cek2."_".$originalName;

                $path = $file->storeAs('public/upload', $newName);
                ${'bukti' . ($index + 1)} = $newName;
            }
        }
        
        $cek3=DB::table("transaksi")->where("transaksi_id",$cek2)
        ->update(['transaksi_bukti1' => $bukti1,'transaksi_bukti2' => $bukti2,'transaksi_bukti3' => $bukti3]);

        $cek3=DB::table("user")->where("user_id",$r->user_id)
        ->update(['user_status' => 'Active']);

        return redirect()->back()->with("success","Data telah disimpan");
    }
    public function viewRenewalDel(Request $r){
        if(isset($r->id)){
            $trans_id=$r->id;
            $uid=$r->userid;
            $cek1=DB::table("transaksi")->where("transaksi_id",$trans_id)
            ->update(["deleted_at"=>Carbon::now()->format('Y-m-d H:i:s')]);

            $cek2=DB::table("transaksi")->where("user_id",$uid)
            ->where("deleted_at",null)->first();
            if(!$cek2){
                $cek3=DB::table("user")->where("user_id",$uid)
                ->update(['user_status' => 'Banned']);
            }
            return "success";
        }
    }
    public function getDataBukti($r){
        $data=DB::table("transaksi")->where("transaksi_id",$r)->get();

        return $data;
    }

    // Event
    public function viewEvent(){
        $vevent=DB::table('event')->where("deleted_at",null)->where("event_end",">=",Carbon::now())->get();
        // $vevent=DB::select("select event.*,cast(CURRENT_DATE() as datetime) as tglsekarang from event where deleted_at is null and event_end>=CURRENT_DATE()");
        // $vevent=DB::select("select v.*,(select count(user_id) from eventd as d where d.event_id=v.event_id) as totalpeserta 
        // from event v where v.deleted_at is null");

        $veventd=DB::table('eventd')->where("deleted_at",null)->get();
        // $vmember=DB::table('user')->where("user_status","Active")->get();
        $vmember=DB::table('user')->where("user_status","Active")->where("user_role","!=","Admin")->get();
        $vfasilitas=DB::table('fasilitas')->where("deleted_at",null)->get();

        return view('transaksi.event')->with("vevent",$vevent)->with("vmember",$vmember)->with("vfasilitas",$vfasilitas);
    }
    public function getDataEvent(){
        $data=DB::select("select v.*,(select count(user_id) from eventd as d where d.event_id=v.event_id) as totalpeserta,current_date() as  tglsekarang
        from event v where v.deleted_at is null order by v.event_id desc ");

        return $data;
    }
    public function viewEventSave(Request $r){
        $cek1=$r->validate([
            'nama' => 'required',
            'valtglawal' => 'required',
            'valtglakhir' => 'required',
            'eventby'=>'required'
        ]);

        DB::beginTransaction();
        if($r->event_id=="" or $r->event_id<=0){
            $cek2=DB::table("event")->insertGetId(
                ["event_nama"=>$r->nama,
                "event_start"=>$r->valtglawal,
                "event_end"=>$r->valtglakhir,
                'event_by'=>$r->eventby
            ]);
            $eventid=$cek2;
        }else{
            $cek2=DB::table('event')
            ->where("event_id",$r->event_id)
            ->update(['event_nama' => $r->nama,"event_start"=>$r->valtglawal,
            'event_end' => $r->valtglakhir,"event_by"=>$r->eventby]);
            $eventid=$r->event_id;
        }

        $cek3a=DB::table('eventfas')
            ->where("event_id",$r->event_id)
            ->update(["deleted_at"=>Carbon::now()->format('Y-m-d H:i:s')]);
        
        $cekstatus=true;
        try {
            $fasilitas=(object)$r->nm_fasilitas;
            foreach ($fasilitas as $k => $v) {
                $cek3b=DB::table("eventfas")->insert(
                    ["event_id"=>$eventid,
                    "fasilitas_id"=>$v
                ]);
            }
        } catch (Exception $e) {
            $cekstatus=false;
        }
        if($cekstatus==true){
            return back()->with("success","Data telah disimpan");
        }else{
            DB::rollBack();
            return back()->with("error","Gagal simpan data");
        }
    }
    public function viewEventSaveReg(Request $r){
        $cek1=$r->validate([
            'nm_member' => 'required',
            'nm_event' => 'required',            
        ]);

        $event=(object)$r->nm_event;
        foreach ($event as $k => $v) {
            $cek2=DB::table("eventd")
            ->where("deleted_at",null)->where("event_id",$v)->where("user_id",$r->nm_member)->first();            
            if(!$cek2->event_id){
                $cek3=DB::table("eventd")->insert(
                    ["event_id"=>$v,
                    "user_id"=>$r->nm_member,
                ]);   
            }
        }

        return back()->with("success","Data telah disimpan");
    }    

    public function viewEventDelPeserta(Request $r){        
        if(isset($r->event_id)){
            $event_id=$r->event_id;
            $cek1=DB::table("event")->where("event_id",$event_id)
            ->update(["deleted_at"=>Carbon::now()->format('Y-m-d H:i:s')]);

            $pesan="Failed";
            if($cek1){$pesan="success";}
            return $pesan;
        }
    }    
    
    public function getDataPeserta(Request $r){
        $cek1=$r->validate([
            'event_id' => 'required',            
        ]);
        $data=DB::table("eventd as v")
        ->join('user as u','u.user_id','=','v.user_id')
        ->select('u.*',"v.created_at as tgldaftar","v.event_id")
        ->where("v.deleted_at",null)->where("v.event_id",$r->event_id)->get();

        return $data;
    }    
}
