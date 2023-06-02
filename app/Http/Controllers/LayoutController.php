<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayoutController extends Controller
{
    public function loginPage()
    {
        return view('layout.User_Login');
    }

    public function registerPage()
    {
        return view('layout.User_Register');
    }

    public function adminPage()
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
