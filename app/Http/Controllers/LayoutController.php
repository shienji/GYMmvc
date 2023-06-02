<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('layout.User_Admin_Profile');
    }
}
