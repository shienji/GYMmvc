<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LayoutController extends Controller
{
    public function loginPage(Request $request)
    {
        $p = $request->session()->get('user_email');
        $request->session()->forget('user_email');
        if ($request->session()->get('user_email') == '' || $request->session()->get('nama') == '') {
            return view('layout.User_Login');
        } else if ($request->session()->get('nama') == 'Admin') {
            $request->session()->put('user_email', $p);
            return redirect(route("layout-adminpage"));
        } else  if ($request->session()->get('nama') == 'Gold') {
            $request->session()->put('user_email', $p);
            dd($request);
            return redirect(route("layout-userpage"));
        } else  if ($request->session()->get('nama') == 'Silver') {
            $request->session()->put('user_email', $p);
            return redirect(route("layout-userpage"));
        } else  if ($request->session()->get('nama') == 'Bronze') {
            $request->session()->put('user_email', $p);
            return redirect(route("layout-userpage"));
        } else {
            return view('layout.User_Login');
        }
    }
    public function actionlogin(Request $request)
    {
        //AMBIL DATA
        $user = $request->input('user_email');
        $password = $request->input('user_password');
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
                return redirect(route("layout-userpage"));
            } else if ($datarole == 'Silver') {
                $request->session()->put('nama', 'Silver');
                $request->session()->put('user_email', $user);
                return redirect(route("layout-userpage"));
            } else if ($datarole == 'Bronze') {
                $request->session()->put('nama', 'Bronze');
                $request->session()->put('user_email', $user);
                return redirect(route("layout-userpage"));
            }
            //GAGAL LOGIN
        } else {
            return view('layout.User_Login');
        }
    }

    public function registerPage()
    {
        return view('layout.User_Register');
    }

    public function adminPage(request $request)
    {
        if ($request->session()->get('nama') == 'Admin') {
            $a = $request->session()->get('nama');
            $b = $request->session()->get('user_email');
            $admin = DB::table('user')->where("user_role", $a)->where("user_email", $b)->get();
            return view('layout.User_Admin_Profile')->with("admin", $admin);
        } else if ($request->session()->get('nama') == 'Gold' || $request->session()->get('nama') == 'Silver' || $request->session()->get('nama') == 'Bronze') {
            return redirect(route("layout-userpage"));
        } else {
            return redirect(route("layout-loginpage"));
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
