<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Kontak;

class KontakController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/kontak/buatkontak') {
        return view('buatKontak');
      }
      else if ($route == '/kontak/kelolakontak') {
        $dataKontak = $this->read(); //GET ALL DATA HIBAH
        return view('kelolaKontak', compact('dataKontak'));
      }
    }
    else {
      return view('login');
    }
  }

  public function edit($id)
  {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    if ($check) {
      $dataKontak = Kontak::find($id); //FIND SPECIFIC MOU
      return view('editKontak', compact('dataKontak'));
    }
    else {
      return view('login');
    }
  }

  public function create(Request $request) {
    $createValidator = Validator::make($request->all(), [
      'phone' => 'required',
      'email' => 'required',
      'nama' => 'required',
      'foto' => 'required',
      'institusi' => 'required',
      'expertise' => 'required',
      'deskripsi' => 'required'
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Membuat Kontak, Harap Mengisi Semua Data.'); 
      return redirect('/kontak/buatkontak'); //REDIRECT BACK TO BUAT KONTAK PAGE
    }

    //INPUT NEW FILE
    $kontak  = Kontak::create($request->all()); //SIMPAN SEMUA MASUKAN DALAM BENTUK KONTAK
    $namaKontak = $kontak->nama; //GET NAMA KONTAK

    $fotoName = $kontak->id . '_' . $request->nama . '.' . 
      $request->file('foto')->getClientOriginalExtension(); //SIMPAN NAMA FOTO
    $request->file('foto')->move(public_path('/upload/fotoKontak'), $fotoName); //SIMPAN FOTO KE FOLDER FOTO KONTAK
    $kontak->foto = $fotoName; //MENAMAKAN FILE FOTO DIDALAM DATABASE

    $kontak->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
    Session::flash('flash_message','Kontak Dengan Nama ' . $namaKontak . ' Telah Berhasil Dibuat'); //FLASH MESSAGE IF SUCCESS
    return redirect('/kontak/kelolakontak');
  }

  public function delete($id) {
    $kontak = Kontak::find($id); //FIND SPECIFIC MOU
    Session::flash('flash_message','Kontak ' . $kontak->nama . ' Telah Dihapus');
    
    $fotoName = public_path('upload/fotoKontak/' . $kontak->foto); //GET SPECIFIC MOU FILE NAME
    if(File::exists($fotoName)) {
      File::delete($fotoName); //DELETE FILE FROM DIRECTORY
      $kontak->delete(); //DELETE FROM DATABASE 
    }
    return redirect('/kontak/kelolakontak'); //REDIRECT BACK TO MOU PAGE
  }

  public function update(Request $request, $id) {
    $updateValidator = Validator::make($request->all(), [
      'phone' => 'required',
      'email' => 'required',
      'nama' => 'required',
      'institusi' => 'required',
      'expertise' => 'required',
      'deskripsi' => 'required'
    ]);

    //VALIDATOR JIKA JUDUL MOU DAN/ATAU NAMA PENELITI TIDAK DIISI
    if ($updateValidator->fails()) {
      Session::flash('flash_message', 'Harap Mengisi Semua Data!'); //nampilin kalo sukses
      return redirect('/kontak/kelolakontak'); //REDIRECT TO KELOLA KONTAK PAGE
    }

    //CHECK FOTO YANG DIUPLOAD KOSONG ATAU ENGGA
    $checkFoto = Validator::make($request->all(), [
        'foto' => 'required',
    ]);

    $kontakNew = $request; //GET HIBAH NEW BY REQUEST USER
    $kontakOld = Kontak::find($id); //GET HIBAH OLD BY FIND ON TABLE HIBAH

    //REPLACE THE OLD WITH THE NEW ONES
    $kontakOld->phone     = $kontakNew->phone;
    $kontakOld->email     = $kontakNew->email;
    $kontakOld->nama      = $kontakNew->nama;
    $kontakOld->institusi = $kontakNew->institusi;
    $kontakOld->expertise = $kontakNew->expertise;
    $kontakOld->deskripsi = $kontakNew->deskripsi;

    //IF UPLOAD FOTO KOSONG
    if ($checkFoto->fails()) {
      $kontakOld->foto = $kontakOld->foto; //KEEP OLD FILE
    }

    //IF UPLOAD FOTO TIDAK KOSONG
    else {
      //DELETE THE OLD FILES IN FOLDER MOU
      $fotoNameOld = public_path('upload/fotoKontak/' . $kontakOld->foto); //GET SPECIFIC OLD FOTO NAME
      if(File::exists($fotoNameOld)) {
          File::delete($fotoNameOld); //DELETE FILE FROM FOLDER FOTO KONTAK
      }

      //STORE NEW FOTO TO FOLDER MOU
      $kontakNewFoto = $kontakNew->id . '_' . $kontakNew->nama . '.' . 
        $request->file('foto')->getClientOriginalExtension(); //SIMPAN NAMA FILE
      $kontakNew->file('foto')->move(base_path().'/public/upload/fotoKontak', $kontakNewFoto); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $kontakOld->foto  = $kontakNewFoto;
    }        

    $kontakOld->save(); //SAVE TO DATABASE
    Session::flash('flash_message', 'Kontak ' . $kontakNew->nama . ' Berhasil Diperbaharui'); //FLASH MESSAGE
    return redirect('/kontak/kelolakontak'); //REDIRECT BACK TO MOU PAGE
  }

  public function read() {
    $dataKontak = Kontak::all(); //GET ALL DATA
    return $dataKontak;
  }
}
