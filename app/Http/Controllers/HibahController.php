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
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      if($route == '/hibah/buatHibah') {
        return view('/hibah/buatHibah');
      }
      else if ($route == '/hibah/kelolaHibah') {
        $dataHibah = $this->read(); //GET ALL DATA HIBAH
        return view('/hibah/kelolaHibah', compact('dataHibah'));
      }
      else {
        $dataHibah = $this->read(); //GET ALL DATA HIBAH
        return view('/hibah/kelolaHibah', compact('dataHibah'));
      }
    }
    else {
      return view('login');
    }
  }

  public function indexDosen() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      $dataHibah = $this->read(); //GET ALL DATA HIBAH
      return view('/hibah/daftarHibah', compact('dataHibah'));
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
      return view('/hibah/applyHibah', compact('dataHibah'));
    }
    else {
      return view('login');
    }
  }

  public function edit($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    if($check) {
        $dataHibah = Hibah::find($id); //GET SPECIFIC HIBAH
        return view('/hibah/editHibah', compact('dataHibah'));
    }
    else {
        return view('login');
    }
  }
  
  public function create(Request $request) {
    $createValidator = Validator::make($request->all(), [
      'kategori_hibah' => 'required',
      'tgl_awal' => 'required',
      'tgl_akhir' => 'required',
      'staf_riset' => 'required',
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO HIBAH PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Membuat Hibah, Harap Mengisi Semua Data.'); 
      return redirect('/hibah/buatHibah');
    }

    //INPUT NEW FILE
    $hibah = Hibah::create($request->all()); //SIMPAN SEMUA MASUKAN DALAM BENTUK HIBAH

    //CHANGE TGL AWAL & AKHIR
    $hibah->tgl_awal = $this->string_to_date($request->tgl_awal);
    $hibah->tgl_akhir = $this->string_to_date($request->tgl_akhir);

    $hibah->besar_dana = $this->getRupiah($hibah->nominal); //PARSE NOMINAL TO RUPIAH
    $hibah->nominal = $request->nominal;
    $hibah->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
    Session::flash('flash_message', $hibah->nama_hibah . ' Telah Tersimpan'); //FLASH MESSAGE IF SUCCESS
    return redirect('/hibah/kelolaHibah');
  }

  public function read() {
    $dataHibah = Hibah::orderBy('tgl_awal')->paginate(15); //GET ALL DATA
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
      'nominal' => 'required',
      'tgl_awal' => 'required',
      'tgl_akhir' => 'required',
      'staf_riset' => 'required'
    ]);

    //IF CHECK THEN REDIRECT
    if ($updateValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Memperbaharui Hibah, Harap Mengisi Semua Data');
      return redirect('/hibah/editHibah/{id}'); 
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
    $hibahOld->tgl_awal         = $this->string_to_date($hibahNew->tgl_awal);
    $hibahOld->tgl_akhir        = $this->string_to_date($hibahNew->tgl_akhir);
    $hibahOld->staf_riset       = $hibahNew->staf_riset;
    $hibahOld->save(); //SAVE TO DATABASE

    Session::flash('flash_message', $hibahOld->nama_hibah . ' Telah Diubah'); //FLASH MESSAGE IF SUCCESS
    return redirect('/hibah/kelolaHibah');
  }

  public function delete($id) {
    $hibah = Hibah::find($id);  //GET SPECIFIC HIBAH
    Session::flash('flash_message',$hibah->nama_hibah . ' Telah Dihapus'); //FLASH MESSAGE IF SUCCESS
    $hibah->delete(); //DELETE FROM DATABASE
    return redirect('/hibah/kelolaHibah');
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
    return redirect('/hibah/kelolaHibah');
  }

  public function nonaktif($id){
    $hibah = Hibah::find($id);
    $hibah->status = 2;
    $hibah->save();
    Session::flash('flash_message', 'Hibah berhasil Non-Aktifkan!');
    return redirect('/hibah/kelolaHibah');
  }

  public function string_to_date($string) {
    $list = explode(", ", $string);
    $list2 = explode(" ", $list[0]);
    $day = $list2[0];
    $month = "";
    $year = $list[1];
    $monthName = array('January', 'February', 'March', 'April', 'May', "June", 
      'July', 'August', 'September', 'October', 'November', 'December');
    $monthNum = array('1', '2', '3', '4', '5', "6", 
      '7', '8', '9', '10', '11', '12');
    for ($i = 0; $i < 12 ; $i++) { 
      if ($list2[1] == $monthName[$i]) {
        $month = $monthNum[$i];
        break;
      }
    }
    $stringDate = $month . "/" . $day . "/" . $year;
    $time = strtotime($stringDate);
    $date = date('Y-m-d',$time);
    return $date;
  }
}