<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use File;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Kontak;
use App\Expertise;

class KontakController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if ($route == '/kontak/buatKontak') {
        return view('kontak/buatKontak');
      }
      else {
        $dataKontak = $this->read(); //GET ALL DATA KONTAK
        return view('/kontak/kelolaKontak', compact('dataKontak'));
      }
    }
    else {
      return view('login');
    }
  }

  public function edit($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    if ($check) {
      $dataKontak = Kontak::find($id); //FIND SPECIFIC MOU
      return view('/kontak/editKontak', compact('dataKontak'));
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
      return redirect('/kontak/buatKontak'); //REDIRECT BACK TO BUAT KONTAK PAGE
    }

    //FILL FOR TABLE KONTAK
    $kontak = Kontak::create($request->all());
    //SIMPAN NAMA FOTO
    $fotoName = $kontak->id . '_' . $request->nama . '.' . $request->file('foto')->getClientOriginalExtension();
    //SIMPAN FOTO KE FOLDER FOTO KONTAK
    $request->file('foto')->move(public_path('/upload/fotoKontak'), $fotoName); 
    //MENAMAKAN FILE FOTO DIDALAM DATABASE
    $kontak->foto = $fotoName; 
    //END OF FILL FOR TABLE KONTAK

    //FILL FOR TABLE EXPERTISE
    $list = explode(";", $request->expertise);
    $count = count($list);
    for($i = 0; $i < $count; $i++) {
      $expertise = new Expertise;
      $expertise->id_kontak = $kontak->id;
      $expertise->expertise = $list[$i];
      $expertise->save();
    }

    $kontak->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
    Session::flash('flash_message','Kontak Dengan Nama ' . $kontak->nama . ' Telah Berhasil Dibuat'); //FLASH MESSAGE IF SUCCESS
    return redirect('/kontak/kelolaKontak');
  }

  public function read() {
    $dataKontak = Kontak::orderBy('nama')->paginate(16); //GET ALL DATA
    return $dataKontak;
  }

  public function delete($id) {
    $kontak = Kontak::find($id); //FIND SPECIFIC MOU
    Session::flash('flash_message','Kontak ' . $kontak->nama . ' Telah Dihapus');
    
    $fotoName = public_path('upload/fotoKontak/' . $kontak->foto); //GET SPECIFIC MOU FILE NAME
    if(File::exists($fotoName)) {
      File::delete($fotoName); //DELETE FILE FROM DIRECTORY
      $kontak->delete(); //DELETE FROM DATABASE 
    }
    return redirect('/kontak/kelolaKontak'); //REDIRECT BACK TO MOU PAGE
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
      return redirect('/kontak/kelolaKontak'); //REDIRECT TO KELOLA KONTAK PAGE
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

    //FILL FOR TABLE EXPERTISE
    //NEW INPUT
    $list = explode(";", $request->expertise);
    $countNew = count($list);

    //OLD INPUT
    $expertiseOld = Kontak::find($kontakOld->id)->getExpertise;
    $countOld = count($expertiseOld);

    //CHECK INPUTAN EXPERTISE BERUBAH ATAU ENGGA
    $check = 1;
    if($countOld == $countNew) {
      $i = 0;
      foreach ($expertiseOld as $expertise) {
        if($expertise->expertise == $list[$i]) {
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
      foreach ($expertiseOld as $expertise) {
        $expertise->delete(); 
      }
      //INPUT NEW EXPERTISE
      for($i = 0; $i < $countNew; $i++) {
        $expertise = new Expertise;
        $expertise->id_kontak = $kontakOld->id;
        $expertise->expertise = $list[$i];
        $expertise->save();
      } 
    }

    $kontakOld->save(); //SAVE TO DATABASE
    Session::flash('flash_message', 'Kontak ' . $kontakNew->nama . ' Berhasil Diperbaharui'); //FLASH MESSAGE
    return redirect('/kontak/kelolaKontak'); //REDIRECT BACK TO MOU PAGE
  }

  public function search(Request $request) {
    $category = $request->category;
    $word = $request->word;

    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

    if ($check) {
      if ($category == "all") {  
        $dataKontak = Kontak::join('expertise', 'kontak.id', '=', 'expertise.id_kontak')
          ->select('kontak.id', 'phone', 'email', 'nama', 'foto', 'institusi', 'deskripsi')
          ->orWhere('nama', 'like', '%' . $word . '%')
          ->orWhere('phone', 'like', '%' . $word . '%')
          ->orWhere('email', 'like', '%' . $word . '%')
          ->orWhere('institusi', 'like', '%' . $word . '%')
          ->orwhere('expertise.expertise', 'like', '%' . $word . '%')
          ->distinct()
          ->orderBy('nama')
          ->get();
      }
      else if ($category == "nama") {
        $dataKontak = Kontak::where('nama', 'like', '%' . $word . '%')->orderBy('nama')->get();
      }
      else if ($category == "phone") {
        $dataKontak = Kontak::where('phone', 'like', '%' . $word . '%')->orderBy('nama')->get();
      }
      else if ($category == "email") {
        $dataKontak = Kontak::where('email', 'like', '%' . $word . '%')->orderBy('nama')->get();
      }
      else if ($category == "institusi") {
        $dataKontak = Kontak::where('institusi', 'like', '%' . $word . '%')->orderBy('nama')->get();
      }
      else if ($category == "expertise") {
        $dataKontak = Kontak::join('expertise', 'kontak.id', '=', 'expertise.id_kontak')
          ->select('kontak.id', 'phone', 'email', 'nama', 'foto', 'institusi', 'deskripsi')
          ->where('expertise.expertise', 'like', '%' . $word . '%')
          ->distinct()
          ->orderBy('nama')
          ->get();
      }

      return view('/kontak/kelolaKontak', compact('dataKontak'));
    }
  }
}