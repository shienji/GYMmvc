<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function loginPage(){
        return view('layout.login');
    }
}
