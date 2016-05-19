<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Pengumuman;
use Session;
use DB;

class BerandaController extends Controller
{
    public function index()
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();        
        // get semua pengumuman yang statusnya udah published
        $allPengumuman = DB::table('pengumuman')
            ->join('users', 'pengumuman.staf_riset', '=', 'users.id')
            ->where('pengumuman.status', '=', 1)
            ->select('pengumuman.*', 'users.nama')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);
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
            $pengumuman = DB::table('pengumuman')
            ->join('users', 'pengumuman.staf_riset', '=', 'users.id')
            ->where('pengumuman.id', '=',$id)
            ->select('pengumuman.*', 'users.nama')
            ->get();
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
