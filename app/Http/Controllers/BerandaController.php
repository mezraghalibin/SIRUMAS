<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Pengumuman;
use Session;

class BerandaController extends Controller
{
    public function index()
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        // get semua pengumuman yang statusnya udah published
        $allPengumuman = Pengumuman::where('status', 1)->get();
        if($check) {
            return view('beranda', compact('allPengumuman'));
        }
        else {
            return view('login');
        }
    }

    public function show($id){
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {  
            $pengumuman = Pengumuman::find($id);
            //dd($pengumuman);
            if(!$pengumuman){
                abort(404);
            } else {
                return view('detailPengumuman',compact('pengumuman'));    
            }
        }
        else {
            return view('login');
        }
    }
}
