<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Hibah;

class HibahController extends Controller
{
    public function index() {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
        if($check) {
            $dataHibah = $this->read(); //GET ALL HIBAH
            return view('hibah', compact('dataHibah'));
        }
        else {
            return view('login');
        }
    }
    public function applyHibah($id) {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $dataHibah = Hibah::find($id); //GET SPECIFIC HIBAH
            return view('applyHibah', compact('dataHibah'));
        }
        else {
            return view('login');
        }
    }
   
    public function kelolaHibah($id) {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $dataHibah = Hibah::find($id); //GET SPECIFIC HIBAH
            return view('kelolaHibah', compact('dataHibah'));
        }
        else {
            return view('login');
        }
    }
    
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_hibah' => 'required',
            'deskripsi' => 'required',
            'kategori_hibah' => 'required',
            'besar_dana' => 'required',
            'pemberi' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'staf_riset' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message','Semua Data Harus Terisi'); //nampilin kalo sukses
            return redirect('hibah');
        }

        //INPUT NEW FILE
        $hibah = Hibah::create($request->all()); //SIMPAN SEMUA MASUKAN KE DATABASE
        $namaHibah = $hibah->nama_hibah; //GET NAMA HIBAH

        $hibah->besar_dana = $this->getRupiah($hibah->besar_dana); //PARSE NOMINAL TO RUPIAH
        $hibah->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
        Session::flash('flash_message',$namaHibah . ' Telah Tersimpan'); //nampilin kalo sukses
        return redirect('hibah');
    }

    public function read() {
        $dataHibah = Hibah::all();
        return $dataHibah;
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'nama_hibah' => 'required',
            'deskripsi' => 'required',
            'kategori_hibah' => 'required',
            'besar_dana' => 'required',
            'pemberi' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'staf_riset' => 'required'
        ]);

        $hibahNew = $request; //GET HIBAH NEW BY REQUEST USER
        $hibahOld = Hibah::find($id); //GET HIBAH OLD BY FIND ON TABLE HIBAH

        //REPLACE THE OLD WITH THE NEW ONES
        $hibahOld->nama_hibah       = $hibahNew->nama_hibah;
        $hibahOld->deskripsi        = $hibahNew->deskripsi;
        $hibahOld->kategori_hibah   = $hibahNew->kategori_hibah;
        $hibahOld->besar_dana       = $this->getRupiah($hibahNew->besar_dana);
        $hibahOld->pemberi          = $hibahNew->pemberi;
        $hibahOld->tgl_awal         = $hibahNew->tgl_awal;
        $hibahOld->tgl_akhir        = $hibahNew->tgl_akhir;
        $hibahOld->staf_riset       = $hibahNew->staf_riset;

        $namaHibah = $hibahOld->nama_hibah;
        $hibahOld->save();
        Session::flash('flash_message',$namaHibah . ' Telah Diubah'); //nampilin kalo sukses
        return redirect('hibah');
    }

    public function delete($id) {
        Hibah::find($id)->delete();
        return redirect('hibah');
    }

    public function getRupiah($nominal) {
        //PARSE NOMINAL TO RUPIAH
        $length = strlen($nominal);
        $rupiah = "";
        $counter = 0;
        for ($i = $length-1; $i >= 0; $i--) {
            if ($counter == 3) {
                $rupiah = $nominal[$i] . "." . $rupiah;
                $counter = 0;
            }
            else {
                $rupiah = $nominal[$i] . $rupiah;
            }
            $counter = $counter+1;
        }
        return "Rp. " .  $rupiah . ",-";
    }
}