<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;
use App\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('pengumuman');
        }
        else {
            return view('login');
        }
    }

    public function kelola()
    {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('kelolapengumuman');
        }
        else {
            return view('login');
        }
    }

    //METHOD STORE PENGUMUMAN KE DATABASE
    public function store(Request $request){
        //VALIDASI INPUT
        $this->validate($request, [
            'judul' => 'required',
            'nomor' => 'required',
            'kategori' => 'required',
            'konten' => 'required',
            ]);
        //BIKIN PENGUMUMAN BARU
        $createPengumuman = Pesan::create($request->all());
        Session::flash('flash_message','Pengumuman berhasil dibuat');
        return redirect('pengumuman');
    }

}
