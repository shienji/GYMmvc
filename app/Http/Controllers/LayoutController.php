<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LayoutController extends Controller
{
    public function loginPage()
    {
        if (Auth::check()) {
            return redirect('layout.User_Admin_profile');
        } else {
            return view('layout.User_Login');
        }
    }
    public function actionlogin(Request $request)
    {
        if (Auth::attempt([
            "user_email" => $request->user_email,
            "user_password" => $request->user_password,
        ])) {
            return redirect(route("layout-adminpage"));
        } else {
            return redirect()->back()
                ->with("error", "User atau password salah!");
        }
    }
    public function registerPage()
    {
        return view('layout.User_Register');
    }

    public function adminPage(request $data)
    {
        $a = "Admin";
        $admin = DB::table('user')->where("user_role", $a)->get();
        return view('layout.User_Admin_Profile')->with("admin", $admin);
    }
    public function userPage()
    {
        $u = "Gold";
        $user = DB::table('user')->where("user_role", $u)->get();
        return view('layout.User_User_Profile')->with("user", $user);
    }
}
