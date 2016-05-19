<?php

namespace App\Http\Controllers;


use Session;
use Validator;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\FunctionController;
use App\Penelitian;
use App\Penelitian_Anggota;
use App\Mahasiswa_Terlibat;
use App\users;
use DB;

class PenelitianController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/kelolaRepository/penelitian/buat') {
        return view('/penelitian/buatPenelitian');
      }
      else if ($route == '/kelolaRepository/penelitian/kelola') {
        $dataPenelitian = $this->read(); //GET ALL DATA HIBAH
        return view('/penelitian/kelolaPenelitian', compact('dataPenelitian'));
      }
    }
    else {
      return view('login');
    }
  }

  public function daftarPenelitian() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      $dataPenelitian = $this->read(); //GET ALL DATA HIBAH
      return view('/penelitian/daftarPenelitian', compact('dataPenelitian'));
    }
    else {
      return view('login');
    }
  }
  
  public function kelola() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) { 
      return view('kelolapenelitian');
    }
    else {
      return view('login');
    }
  }

  public function store(Request $request) {
    $createValidator = Validator::make($request->all(), [
      
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Harap Mengisi Semua Data.'); 
      return redirect('/kelolaRepository/penelitian/buat'); //REDIRECT BACK TO BUAT PENELITIAN PAGE
    }

    //BIKIN PENELITIAN BARU
    $penelitian = Penelitian::create($request->all());

    $function = new FunctionController(); //CLASS -> OBJECT FOR ALL FUNCTION
    $penelitian->besar_dana = $function->getRupiah($penelitian->nominal); //PARSE NOMINAL TO RUPIAH
    $penelitian->nominal = $request->nominal;
    $filename = $request->file('file')->getClientOriginalName(); 
    $request->file('file')->move(base_path().'/public/upload/penelitian', $filename);
    //UBAH FILENAME DI DATABASE
    $penelitian->file = $filename;

    //FILL FOR TABLE PENELITIAN_ANGGOTA
    $list = explode(";", $request->nama_anggota);
    $count = count($list);
    for($i = 0; $i < $count; $i++) {
      $penelitian_anggota = new Penelitian_Anggota;
      $penelitian_anggota->id_penelitian = $penelitian->id;
      $penelitian_anggota->nama_anggota = $list[$i];
      $penelitian_anggota->save();
    }

    //FILL FOR TABLE MAHASISWA_TERLIBAT
    $list = explode(";", $request->nama_mhs);
    $count = count($list);
    for($i = 0; $i < $count; $i++) {
      $mahasiswa_terlibat = new Mahasiswa_Terlibat;
      $mahasiswa_terlibat->id_penelitian = $penelitian->id;
      $mahasiswa_terlibat->nama_mhs = $list[$i];
      $mahasiswa_terlibat->save();
    }

    $penelitian->save();
    Session::flash('flash_message','Penelitian ' . $penelitian->judul . ' Berhasil Dibuat'); //FLASH
    return redirect('/kelolaRepository/penelitian/kelola');    
  }

  public function edit($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    if ($check) {
      $penelitian = Penelitian::find($id); //FIND SPECIFIC MOU
      return view('/penelitian/editPenelitian', compact('penelitian'));
    }
    else {
      return view('login');
    }
  }


  public function update(Request $request, $id) {
    $function = new FunctionController(); //CLASS -> OBJECT FOR ALL FUNCTION
    $createValidator = Validator::make($request->all(), [
      
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Mengubah Penelitian, Harap Mengisi Semua Data.'); 
      return redirect('/kelolaRepository/penelitian/edit/{$id}'); //REDIRECT BACK TO EDIT PRESENTASI PAGE
    }

    $checkFile = Validator::make($request->all(), [
      'file' => 'required'
    ]);


    //IF FILE BARU IS NULL
    
    $penelitianNew = $request; //GET JADWAL NEW BY REQUEST USER
    $penelitianOld = Penelitian::find($id); //GET JADWAL OLD BY FIND ON TABLE JADWAL_PRESETASI

    //REPLACE THE OLD WITH THE NEW ONES
    $penelitianOld->judul       = $penelitianNew->judul;
    $penelitianOld->ketua       = $penelitianNew->ketua;
    $penelitianOld->sumber_dana = $penelitianNew->sumber_dana;
    $penelitianOld->besar_dana  = $function->getRupiah($penelitianNew->nominal);
    $penelitianOld->nominal     = $request->nominal;
    $penelitianOld->staf_riset  = $penelitianNew->staf_riset;    
    
    if ($checkFile->fails()) {
       $penelitianOld->file = $penelitianOld->file;
    }
    else {
      $filenameOld = public_path('upload/penelitian/' . $penelitianOld->file);
      if(File::exists($filenameOld)) {
        File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
      }

      //STORE NEW FILE TO FOLDER MOU
      $penelitianNewName = $request->file('file')->getClientOriginalName(); //SIMPAN NAMA FILE
      $penelitianNew->file('file')->move(base_path().'/public/upload/penelitian', $penelitianNewName); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $penelitianOld->file  = $penelitianNewName; //KEEP OLD FILE   
    }

    $list1 = explode(";", $request->nama_anggota);
    $countNew1 = count($list1);

    //OLD INPUT
    $namaAnggotaOld = Penelitian::find($penelitianOld->id)->getAnggota;
    $countOld1 = count($namaAnggotaOld);

    //CHECK INPUTAN EXPERTISE BERUBAH ATAU ENGGA
    $check = 1;
    if($countOld1 == $countNew1) {
      $i = 0;
      foreach ($namaAnggotaOld as $penelitian_anggota) {
        if($penelitian_anggota->nama_anggota == $list1[$i]) {
          $check = 0;
        }
        else {
          break;
        }
        $i++;
      }
    }

    //IF INPUTAN EXPERTISE BERUBAH
    if ($check == 1) {
      //DELETE OLD EXPERTISE
      foreach ($namaAnggotaOld as $penelitian_anggota) {
        $penelitian_anggota->delete(); 
      }
      //INPUT NEW EXPERTISE
      for($i = 0; $i < $countNew1; $i++) {
        $penelitian_anggota = new Penelitian_Anggota;
        $penelitian_anggota->id_penelitian = $penelitianOld->id;
        $penelitian_anggota->nama_anggota = $list1[$i];
        $penelitian_anggota->save();
      } 
    }

    //update field ANGGOTA MHS
    $list = explode(";", $request->nama_mhs);
    $countNew = count($list);

    //OLD INPUT
    $namaMhsOld = Penelitian::find($penelitianOld->id)->getMhsTerlibat;
    $countOld = count($namaMhsOld);

    //CHECK INPUTAN MHS BERUBAH ATAU ENGGA
    $check = 1;
    if($countOld == $countNew) {
      $i = 0;
      foreach ($namaMhsOld as $mahasiswa_terlibat) {
        if($mahasiswa_terlibat->nama_mhs == $list[$i]) {
          $check = 0;
        }
        else {
          break;
        }
        $i++;
      }
    }

    //IF INPUTAN MHS TERLIBAT BERUBAH
    if ($check == 1) {
      //DELETE OLD MHS TERLIBAT
      foreach ($namaMhsOld as $mahasiswa_terlibat) {
        $mahasiswa_terlibat->delete(); 
      }
      //INPUT NEW MHS TERLIBAT
      for($i = 0; $i < $countNew; $i++) {
        $mahasiswa_terlibat = new Mahasiswa_Terlibat;
        $mahasiswa_terlibat->id_penelitian = $penelitianOld->id;
        $mahasiswa_terlibat->nama_mhs = $list[$i];
        $mahasiswa_terlibat->save();
      } 
    }

    //SIMPAN SEMUA MASUKAN DALAM BENTUK PENELITIAN
    $penelitianOld->save();
    Session::flash('flash_message','Penelitian Berhasil Diperbarui'); //FLASH
    return redirect('/kelolaRepository/penelitian/kelola');
  }
    
  public function read() {
    $dataPenelitian = Penelitian::all();
    return $dataPenelitian;
  }

  public function delete($id) {
    $penelitian = Penelitian::find($id); //FIND SPECIFIC PRESENTASI
    Session::flash('flash_message','Penelitian ' . $penelitian->judul . ' Telah Dihapus');

    $filename = public_path('upload/penelitian/' . $penelitian->file); //GET SPECIFIC MOU FILE NAME
    if(File::exists($filename)) {
      File::delete($filename); //DELETE FILE FROM DIRECTORY
      $penelitian->delete(); //DELETE FROM DATABASE 
    }

    return redirect('/kelolaRepository/penelitian/kelola'); //REDIRECT BACK TO KELOLA PENELITIAN PAGE
  }
}