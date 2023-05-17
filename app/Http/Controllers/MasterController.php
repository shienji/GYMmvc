<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function home_master(){
        return view('Master.Home_Master');
    }
    public function role_master(){
        return view('Master.Role_Master');
    }
    public function peralatan_master(){
        return view('Master.Peralatan_Master');
    }
    public function pelatih_master(){
        return view('Master.Pelatih_Master');
    }
    public function fasilitas_master(){
        return view('Master.Fasilitas_Master');
    }
}
