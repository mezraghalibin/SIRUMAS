<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Hibah;

class HibahController extends Controller
{
    public function index()
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('hibah');
        }
        else {
            return view('login');
        }
    }

    public function applyHibah()
    {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('applyHibah');
        }
        else {
            return view('login');
        }
    }

    public function kelolaHibah()
    {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('kelolaHibah');
        }
        else {
            return view('login');
        }
    }
    public function create(Request $request) {
        $this->validate($request, [
            'nama_hibah' => 'required',
            'deskripsi' => 'required',
            'kategori_hibah' => 'required',
            'besar_dana' => 'required',
            'pemberi' => 'required',
            'tgl_awal' => 'required',
            'tgl_akshir' => 'required',
            'staf_riset' => 'required'
        ]);

        //INPUT NEW FILE
        $hibah = Hibah::create($request->all()); //SIMPAN SEMUA MASUKAN KE DATABASE
        $namaHibah = $hibah->nama_hibah; //GET NAMA HIBAH
        $hibah->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
        Session::flash('flash_message',$namaHibah . ' Telah Tersimpan'); //nampilin kalo sukses
        return redirect('hibah');
    }
}
