<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\users;
use App\Hibah;
use App\Proposal;

class HibahController extends Controller {
    public function index() {
      //CHECK IF USER IS LOGGED IN OR NOT
      $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
      $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
      
      //GET ALL USERS DENGAN SPESIFIK ROLE = DOSEN
      $users = users::where('spesifik_role','dosen')->get();

      $id = $SSOController->getId(); //GET ID FROM SSO
      $spesifik_role = $SSOController->getSpesifikRole(); //GET USER'S SPESIFIK ROLE FROM USERS TABLE
      
      if ($check) {
        $dataHibah = $this->read(); //GET ALL HIBAH
        return view('hibah', compact('dataHibah'));
      }
      else {
        return view('login');
      }
    }

    //FUNCTION TO BUATHIBAH PAGE
    public function hibah() {
      //CHECK IF USER IS LOGGED IN OR NOT
      $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
      $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
      
      $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

      if($check) {
        if($route == '/hibah/buathibah') {
          return view('buatHibah');
        }
        else if ($route == '/hibah/kelolahibah') {
          $dataHibah = $this->read(); //GET ALL DATA HIBAH
          return view('kelolahibah', compact('dataHibah'));
        }
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
            return view('kelolaHibahDetail', compact('dataHibah'));
        }
        else {
            return view('login');
        }
    }

    //METHOD STORE PROPOSAL KE DATABASE
    public function storeProposal(Request $request) {
        //VALIDASI INPUT
        $this->validate($request, [
            'nama_pengaju' => 'required',
            'no_hp' => 'required',
            'e-mail' => 'required',
            'nip/nup' => 'required',
            'dosen' => 'required',
            'kategori' => 'required',
            'status' => 'required',
            'judul_proposal' => 'required',
            'file' => 'required',
            'id_hibah' => 'required'
        ]);

        //Bikin proposal
        $proposal = Proposal::create($request->all());
        //untuk upload file, request file dengan segala extensi
        $filename = $request->file('file')->getClientOriginalName();
        //memindahkan file yg dilampirkan tadi ke path /public/upload
        $request->file('file')->move(base_path().'/public/upload/proposal', $filename);
        $proposal->file = $filename;
        //SAVE FILEnya
        $proposal->save();
        // Session untuk Success Notif
        Session::flash('flash_message','Sukses meng-apply hibah');
        // then rederict back to hibah
        return redirect('hibah');
    }
    
  public function create(Request $request) {
    $createValidator = Validator::make($request->all(), [
      'nama_hibah' => 'required',
      'deskripsi' => 'required',
      'kategori_hibah' => 'required',
      'nominal' => 'required',
      'pemberi' => 'required',
      'tgl_awal' => 'required',
      'tgl_akhir' => 'required',
      'staf_riset' => 'required',
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO HIBAH PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Membuat Hibah, Harap Mengisi Semua Data.'); 
      return redirect('/hibah/buathibah');
    }

    //INPUT NEW FILE
    $hibah = Hibah::create($request->all()); //SIMPAN SEMUA MASUKAN DALAM BENTUK HIBAH
    $namaHibah = $hibah->nama_hibah; //GET NAMA HIBAH

    $hibah->besar_dana = $this->getRupiah($hibah->nominal); //PARSE NOMINAL TO RUPIAH
    $hibah->nominal = $request->nominal;
    $hibah->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
    Session::flash('flash_message',$namaHibah . ' Telah Tersimpan'); //FLASH MESSAGE IF SUCCESS
    return redirect('/hibah/kelolahibah');
  }

  public function read() {
    $dataHibah = Hibah::all(); //GET ALL DATA
    return $dataHibah;
  }

    public function readRiset() {
        $dataHibahRiset = DB::table('hibah')
            ->select('*')
            ->where('kategori_hibah', '=', 'Riset')
            ->get();
        return $dataHibahRiset;
    }

    public function readPengmas() {
        $dataHibahPengmas = DB::table('hibah')
            ->select('*')
            ->where('kategori_hibah', '=', 'Pengmas')
            ->get();
        return $dataHibahPengmas;
    }

    public function update(Request $request, $id) {
        //CHECK VALIDATOR
        $updateValidator = Validator::make($request->all(), [
            'nama_hibah' => 'required',
            'deskripsi' => 'required',
            'kategori_hibah' => 'required',
            'nominal' => 'required',
            'pemberi' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'staf_riset' => 'required'
        ]);

        //IF CHECK THEN REDIRECT
        if ($updateValidator->fails()) {
            //FLASH MESSAGE IF FAILS
            Session::flash('flash_message','Gagal Memperbaharui Hibah, Harap Mengisi Semua Data');
            return redirect('/hibah/kelolahibah/detail/{id}'); 
        }

        $hibahNew = $request; //GET HIBAH NEW BY REQUEST USER
        $hibahOld = Hibah::find($id); //GET HIBAH OLD BY FIND ON TABLE HIBAH

        //REPLACE THE OLD WITH THE NEW ONES
        $hibahOld->nama_hibah       = $hibahNew->nama_hibah;
        $hibahOld->deskripsi        = $hibahNew->deskripsi;
        $hibahOld->kategori_hibah   = $hibahNew->kategori_hibah;
        $hibahOld->nominal          = $hibahNew->nominal;
        $hibahOld->besar_dana       = $this->getRupiah($hibahNew->nominal);
        $hibahOld->pemberi          = $hibahNew->pemberi;
        $hibahOld->tgl_awal         = $hibahNew->tgl_awal;
        $hibahOld->tgl_akhir        = $hibahNew->tgl_akhir;
        $hibahOld->staf_riset       = $hibahNew->staf_riset;

        $namaHibah = $hibahOld->nama_hibah; //GET NAME OF OLD HIBAH
        $hibahOld->save(); //SAVE TO DATABASE
        Session::flash('flash_message',$namaHibah . ' Telah Diubah'); //FLASH MESSAGE IF SUCCESS
        return redirect('/hibah/kelolahibah');
    }

  public function delete($id) {
    $hibah = Hibah::find($id);  //GET SPECIFIC HIBAH
    Session::flash('flash_message',$hibah->nama_hibah . ' Telah Dihapus'); //FLASH MESSAGE IF SUCCESS
    $hibah->delete(); //DELETE FROM DATABASE
    return redirect('/hibah/kelolahibah');
  }

    public function getRupiah($angka) {
        //PARSE NOMINAL TO RUPIAH
        $nominal = strval($angka); //INT TO STRING
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

    public function publikasi($id){
        $hibah = Hibah::find($id);
        $hibah->status = 1;
        $hibah->save();
        Session::flash('flash_message', 'Hibah berhasil dipublish!');
        return redirect('/hibah/kelolahibah');
    }

    public function nonaktif($id){
        $hibah = Hibah::find($id);
        $hibah->status = 2;
        $hibah->save();
        Session::flash('flash_message', 'Hibah berhasil Non-Aktifkan!');
        return redirect('/hibah/kelolahibah');
    }
}