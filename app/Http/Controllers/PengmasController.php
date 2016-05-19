<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Validator;
use File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\FunctionController;
use App\users;
use App\Pengmas;
use App\PengmasAnggota;

class PengmasController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/kelolaRepository/pengmas/buat') {
        return view('/pengmas/buatPengmas');
      }
      else if ($route == '/kelolaRepository/pengmas/kelola') {
        $listofpengmas = Pengmas::paginate(10);
        return view('/pengmas/kelolaPengmas', compact('listofpengmas'));
      }
      /** FOR PAGINATION KELOLA BUKU **/
      else {
        $listofpengmas = Pengmas::paginate(10);
        return view('/pengmas/kelolaPengmas', compact('listofpengmas'));
      }
    }
    else {
      return view('login');
    }
  }

  public function daftarPengmas() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    if ($check) {
      $listofpengmas = Pengmas::paginate(10);
      return view('/pengmas/daftarPengmas', compact('listofpengmas'));
    }
  }

  public function store(Request $request) {
    //VALIDASI INPUT
    $storeValidator = Validator::make($request->all(), [
        
    ]);

    //VALIDATOR JIKA INPUT TIDAK DIISI (KECUALI FILE)
    if ($storeValidator->fails()) {
        Session::flash('flash_message', 'Harap mengisi seluruh data'); //FLASH MESSAGE IF FAILS
        return redirect('/kelolaRepository/pengmas/buat'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
    }

    //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
    $checkFile = Validator::make($request->all(), [
      'bukti' => 'required'
    ]);

    //Bikin pengmas
    $pengmas = Pengmas::create($request->all());

    if($checkFile->fails()){
        $pengmas->bukti = "";
    } 
    else {
      //CALL FUNCTION CONTROLLER
      $function = new FunctionController();
      //CHANGE DATE MATERIALIZE TO DATABASE DATE
      $pengmas->waktu = $function->string_to_date($request->waktu);
      //PARSE NOMINAL TO RUPIAH
      $pengmas->besar_dana = $function->getRupiah($pengmas->nominal); //PARSE NOMINAL TO RUPIAH
      //SIMPAN NAMA FILE
      $filename = $request->file('bukti')->getClientOriginalName(); 
      //memindahkan file yg dilampirkan tadi ke path /public/upload
      $request->file('bukti')->move(base_path().'/public/upload/pengmas', $filename);
      //UBAH FILENAME DI DATABASE
      $pengmas->bukti = $filename;
    }

    //ISI anggota
    $list = explode(";", $request->nama_anggota);
    $count = count($list);
    for($i = 0; $i < $count; $i++) {
      $nama_anggota = new PengmasAnggota;
      $nama_anggota->id_pengmas = $pengmas->id;
      $nama_anggota->nama_anggota = $list[$i];
      $nama_anggota->save();
    }

    //SAVE FILEnya
    $pengmas->save();
    // Session untuk Success Notif
    Session::flash('flash_message','Sukses membuat Pengabdian Masyarakat');
    // then rederict back to hibah
    return redirect('/kelolaRepository/pengmas/kelola');
  }

  public function edit($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    if($check) {
      $pengmas = Pengmas::find($id);
      $listofanggota = PengmasAnggota::where('id_pengmas', $id)->get();
      
      if (!$pengmas) { 
        abort(404);
      } 
      else {
        return view('/pengmas/editPengmas', compact('pengmas'), compact('listofanggota'));
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
      return redirect('/kelolaRepository/pengmas/edit/$id'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
    }

    //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
    $checkFile = Validator::make($request->all(), [
      'bukti' => 'required'
    ]);

    $pengmasOld = Pengmas::find($id);
    $function = new FunctionController();

    //CHANGE OLD TO NEW
    $pengmasOld->nama_kegiatan = $request->nama_kegiatan;
    $pengmasOld->ketua         = $request->ketua;
    $pengmasOld->peranan       = $request->peranan;
    $pengmasOld->penyelenggara = $request->penyelenggara;
    $pengmasOld->tempat        = $request->tempat;
    if ($pengmasOld->waktu == $request->waktu) {
      $pengmasOld->waktu = $request->waktu;  
    }
    else {      
      $pengmasOld->waktu = $function->string_to_date($request->waktu);
    }
    $pengmasOld->besar_dana    = $function->getRupiah($request->nominal);
    $pengmasOld->nominal       = $request->nominal;

    if($checkFile->fails()){
      //DO NOTHING
    } 
    else {
       //IF OLD FILE IS NULL OR EMPTY
      $filenameOld = public_path('upload/pengmas/' . $pengmas->bukti); //GET SPECIFIC MOU FILE NAME OLD
      if(File::exists($filenameOld)) {
          File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
      }

      //STORE NEW FILE TO FOLDER MOU
      $pengmasNewName = $request->file('bukti')->getClientOriginalName(); //SIMPAN NAMA FILE
      $pengmasNew->file('bukti')->move(base_path().'/public/upload/pengmas', $pengmasNewName); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $pengmas->bukti  = $pengmasNewName; //KEEP OLD FILE 
    }

    //UBAH anggota
    $list = explode(";", $request->nama_anggota);
    $countNew = count($list);

    //Yang lama
    $anggotaOld = Pengmas::find($id)->getAnggota;
    $countOld = count($anggotaOld);

    //cek inputan anggota berubah atau ga
    $check = 1;
    if($countOld == $countNew) {
      $i = 0;
      foreach ($anggotaOld as $anggota) {
        if($anggota->nama_anggota == $list[$i]) {
          $check = 0;
        } 
        else {
          break;
        }
        $i++;
      }
    }

    // Kalau inputan berubah
    if ($check == 1) {
      //Delete old anggota
      foreach ($anggotaOld as $anggota) {
        $anggota->delete();
      }
      //input yang baru
      for($i = 0; $i < $countNew; $i++) {
        $anggota = new PengmasAnggota;
        $anggota->id_pengmas = $pengmas->id;
        $anggota->nama_anggota = $list[$i];
        $anggota->save();
      }
    }

    //SAVE FILEnya
    $pengmasOld->save();
    // Session untuk Success Notif
    Session::flash('flash_message','Sukses mengubah Pengabdian Masyarakat');
    // then rederict back to hibah
    return redirect('/kelolaRepository/pengmas/kelola');
  }

  public function destroy($id) {
    $pengmas = Pengmas::find($id);

    $filename = public_path('upload/pengmas/' . $pengmas->bukti); //GET SPECIFIC MOU FILE NAME
    if(File::exists($filename)) {
      File::delete($filename); //DELETE FILE FROM DIRECTORY
      Session::flash('flash_message','Pengabdian Masyarakat berhasil dihapus.');      
      $pengmas->delete();
    }
    
    return redirect('/kelolaRepository/pengmas/kelola');
  }
}
