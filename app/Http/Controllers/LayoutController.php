<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LayoutController extends Controller
{
    public function loginPage()
    {
        // $p = $request->session()->get('user_email');
        // $request->session()->forget('user_email');
        // if ($request->session()->get('user_email') == '' || $request->session()->get('nama') == '') {
        //     return view('layout.User_Login');
        // } else if ($request->session()->get('nama') == 'Admin') {
        //     $request->session()->put('user_email', $p);
        //     return redirect(route("layout-adminpage"));
        // } else  if ($request->session()->get('nama') == 'Gold') {
        //     $request->session()->put('user_email', $p);
        //     return redirect(route("layout-userpage"));
        // } else  if ($request->session()->get('nama') == 'Silver') {
        //     $request->session()->put('user_email', $p);
        //     return redirect(route("layout-userpage"));
        // } else  if ($request->session()->get('nama') == 'Bronze') {
        //     $request->session()->put('user_email', $p);
        //     return redirect(route("layout-userpage"));
        // } else {
        //     return view('layout.User_Login');
        // }

        return view('layout.User_Login');
    }
    public function actionlogin(LoginRequest $request)
    {
        // Session()->flush();

        // Auth::logout();
        //AMBIL DATA
        //dd($request);
        $user = $request->input('user_email');
        $password = $request->input('user_password');
        $credentials = $request->getCredentials();
        //dd($credentials);
        //COCOKAN DATA
        $datauser = DB::table('user')->where("user_email", $user)->value('user_email');
        $datapassword = DB::table('user')->where("user_password", $password)->value('user_password');
        $datarole = DB::table('user')->where("user_password", $password)->value('user_role');
        //PEMBAGIAN
        if ($datauser == $user && $datapassword == $password) {
            if ($datarole == 'Admin') {
                $request->session()->put('nama', 'Admin');
                $request->session()->put('user_email', $user);
                return redirect(route("layout-adminpage"));
            } else if ($datarole == 'Gold') {
                $request->session()->put('nama', 'Gold');
                $request->session()->put('user_email', $user);
                //$user = Auth::getProvider()->retrieveByCredentials($credentials);
                //dd($user);
                return redirect(route("layout-userpage"));
            } else if ($datarole == 'Silver') {
                $request->session()->put('nama', 'Silver');
                $request->session()->put('user_email', $user);
                //$user = Auth::getProvider()->retrieveByCredentials($credentials);
                return redirect(route("layout-userpage"));
            } else if ($datarole == 'Bronze') {
                $request->session()->put('nama', 'Bronze');
                $request->session()->put('user_email', $user);
                $user = Auth::getProvider()->retrieveByCredentials($credentials);
                return redirect(route("layout-userpage"));
            }
            //GAGAL LOGIN
        } else {
            return view('layout.User_Login');
        }
    }

    public function actionLogout()
    {
        Session()->flush();

        Auth::logout();

        return redirect()->route('layout-loginpage');
    }
    public function updateuser(Request $request)
    {
        //dd($request);
        //$user_email = $request->get('user_email');
        //dd($user_email);
        //$id = DB::table('user')->where("user_email", $user_email)->first();
        //dd($id);
        $uid = $request->get('user_id');
        //dd($uid);
        User::where("user_id", $uid)->update([
            "user_email" => $request->user_email,
            "user_nama" => $request->user_nama,
            "user_nik" => $request->user_nik,
            "user_tgllahir" => $request->user_tgllahir,
            "user_nohp" => $request->user_nohp,
            "user_alamat" => $request->user_alamat
        ]);
        return redirect()->back();
    }

    public function registerPage()
    {
        return view('layout.User_Register');
    }

    public function actionRegister(Request $request)
    {
        // $user = $request->input('user_email');
        // $password = $request->input('user_password');
        // dd($user, $password);
        //dd($request);
        // $users = Users::create($request);
        // dd($users);
        // auth()->login($users);
        // $this->validate($request, [
        //     'user_nama' => 'required|email',
        //     'user_email' => 'required',
        //     'user_password' => 'required',
        //     'con_password' => 'required'
        // ]);
        //dd($this);
        // if ('user_password' == 'con_password') {

        // };
        Users::create(request(['user_email', 'user_nama', 'user_password', 'user_role', 'user_nik']));
        // Session()->flush();

        // Auth::logout();
        return redirect()->route('layout-loginpage')->with('alert', 'Berhasil Registrasi!');
    }

    public function adminPage(Request $request)
    {
        if ($request->session()->get('nama') == '') {
            return view('layout.User_Login');
        } else {
            if ($request->session()->get('nama') == 'Admin') {
                $a = $request->session()->get('nama');
                $b = $request->session()->get('user_email');
                $admin = DB::table('user')->where("user_role", $a)->where("user_email", $b)->get();
                return view('layout.User_Admin_Profile')->with("admin", $admin);
            }
        }
    }
    public function userPage(request $request)
    {
        if ($request->session()->get('user_email') == '') {
            return view('layout.User_Login');
        } else {
            if ($request->session()->get('nama') == 'Gold') {
                $u = $request->session()->get('nama');
                $b = $request->session()->get('user_email');
                $user = DB::table('user')->where("user_role", $u)->where("user_email", $b)->get();
                return view('layout.User_User_Profile')->with("user", $user);
            } else if ($request->session()->get('nama') == 'Silver') {
                $u = $request->session()->get('nama');
                $b = $request->session()->get('user_email');
                $user = DB::table('user')->where("user_role", $u)->where("user_email", $b)->get();
                return view('layout.User_User_Profile')->with("user", $user);
            } else if ($request->session()->get('nama') == 'Bronze') {
                $u = $request->session()->get('nama');
                $b = $request->session()->get('user_email');
                $user = DB::table('user')->where("user_role", $u)->where("user_email", $b)->get();
                return view('layout.User_User_Profile')->with("user", $user);
            }
        }
    }
}
