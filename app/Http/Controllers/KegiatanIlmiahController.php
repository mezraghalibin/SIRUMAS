<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use File;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\FunctionController;
use App\users;
use App\KegiatanIlmiah;

class KegiatanIlmiahController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/kelolaRepository/kegiatanIlmiah/buat') {
        return view('/kegiatanIlmiah/buatKegiatanIlmiah');
      }
      else if ($route == '/kelolaRepository/kegiatanIlmiah/kelola') {
        $kegiatanIlmiahs= KegiatanIlmiah::paginate(10);
        return view('/kegiatanIlmiah/kelolaKegiatanIlmiah', compact('kegiatanIlmiahs'));
      }
      /** FOR PAGINATION KELOLA KEGIATAN ILMIAH **/
      else {
        $kegiatanIlmiahs= KegiatanIlmiah::paginate(10);
        return view('/kegiatanIlmiah/kelolaKegiatanIlmiah', compact('kegiatanIlmiahs'));
      }
    }
    else {
      return view('login');
    }
  }

  public function daftarKegiatanIlmiah() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        $kegiatanilmiahs= KegiatanIlmiah::paginate(10);
        return view('kelolakegiatanilmiah', ['kegiatanilmiahs' => $kegiatanilmiahs]);
    }
    else {
        return view('login');
    }
  }
  
  public function store(Request $request) {
    //VALIDASI INPUT
    $storeValidator = Validator::make($request->all(), [
      'jenis' => 'required',
      'skala' => 'required'
    ]);

    //VALIDATOR JIKA INPUT TIDAK DIISI (KECUALI FILE)
    if ($storeValidator->fails()) {
      Session::flash('flash_message', 'Harap mengisi seluruh data'); //FLASH MESSAGE IF FAILS
      return redirect('/kelolaRepository/kegiatanIlmiah/buat'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
    }

    //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
    $checkFile = Validator::make($request->all(), [
      'bukti' => 'required'
    ]);

    //Bikin kegiatan ilmiah
    $kegiatan_ilmiah = KegiatanIlmiah::create($request->all());

    if($checkFile->fails()){
      $kegiatan_ilmiah->bukti = "";
    } else {
      //SIMPAN DATE MATERIALIZE -> DATE DATABASE
      $function = new FunctionController();
      $kegiatan_ilmiah->waktu = $function->string_to_date($request->waktu);
      //SIMPAN NAMA FILE
      $filename = $request->file('bukti')->getClientOriginalName(); 
      //memindahkan file yg dilampirkan tadi ke path /public/upload
      $request->file('bukti')->move(base_path().'/public/upload/kegiatanIlmiah', $filename);
      //UBAH FILENAME DI DATABASE
      $kegiatan_ilmiah->bukti = $filename;
    }

    //SAVE FILEnya
    $kegiatan_ilmiah->save();
    // Session untuk Success Notif
    Session::flash('flash_message','Sukses membuat Kegiatan Ilmiah');
    // then rederict back to hibah
    return redirect('/kelolaRepository/kegiatanIlmiah/kelola');
  }

  public function edit($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
      $kegiatanIlmiah = KegiatanIlmiah::find($id);
      if(!$kegiatanIlmiah){ 
        abort(404);
      } 
      else {
        return view('/kegiatanIlmiah/editKegiatanIlmiah', compact('kegiatanIlmiah'));
      }
    } 
    else {
      return view('login');
    }
  }

  public function update(Request $request, $id) {
    //VALIDASI INPUT
    $storeValidator = Validator::make($request->all(), [
        
    ]);

    //VALIDATOR JIKA INPUT TIDAK DIISI (KECUALI FILE)
    if ($storeValidator->fails()) {
        Session::flash('flash_message', 'Harap mengisi seluruh data'); //FLASH MESSAGE IF FAILS
        return redirect('.kelolaRepository/kegiatanIlmiah/kelola'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
    }

    //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
    $checkFile = Validator::make($request->all(), [
      'bukti' => 'required'
    ]);


    $kegiatanilmiah = KegiatanIlmiah::find($id);
    $function = new FunctionController();

    //CHANGE OLD TO NEW
    $kegiatanilmiah->nama        = $request->nama;
    $kegiatanilmiah->jenis       = $request->jenis;
    $kegiatanilmiah->judul       = $request->judul;
    $kegiatanilmiah->skala       = $request->skala;
    $kegiatanilmiah->pembicara   = $request->pembicara;
    if ($kegiatanilmiah->waktu == $request->waktu){
      $kegiatanilmiah->waktu = $request->waktu;
    }
    else {
      $kegiatanilmiah->waktu = $function->string_to_date($request->waktu);
    }
    $kegiatanilmiah->tempat      = $request->tempat;
    $kegiatanilmiah->sumber_dana = $request->sumber_dana;

    if ($checkFile->fails()) {
        //DO NOTHING
    } 
    else {
      //IF OLD FILE IS NULL OR EMPTY
      $filenameOld = public_path('upload/kegiatanIlmiah/' . $kegiatanilmiah->bukti); //GET SPECIFIC KEGIATAN ILMIAH FILE NAME OLD
      if(File::exists($filenameOld)) {
        File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
      }

      //STORE NEW FILE TO FOLDER MOU
      $ilmiahNewName = $request->file('bukti')->getClientOriginalName(); //SIMPAN NAMA FILE
      $ilmiahNew->file('bukti')->move(base_path().'/public/upload/kegiatanIlmiah', $ilmiahNewName); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $kegiatanilmiah->bukti  = $ilmiahNewName; //KEEP OLD FILE       
    }

    $kegiatanilmiah->save(); // save the array of models at once
    Session::flash('flash_message','Kegiatan Ilmiah berhasil diubah.');
    return redirect('/kelolaRepository/kegiatanIlmiah/kelola');
  }

  public function destroy($id) {
    $kegiatanilmiah = KegiatanIlmiah::find($id);

    $filename = public_path('upload/kegiatanIlmiah/' . $kegiatanilmiah->bukti);  //GET SPECIFIC MOU FILE NAME
    if(File::exists($filename)) {
      File::delete($filename); //DELETE FILE FROM DIRECTORY
      $kegiatanilmiah->delete(); //DELETE FROM DATABASE 
      Session::flash('flash_message','Kegiatan Ilmiah berhasil dihapus.');
    }

    return redirect('/kelolaRepository/kegiatanIlmiah/kelola');
  }
}
