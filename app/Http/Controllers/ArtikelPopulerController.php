<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Validator;
use File;
use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\FunctionController;
use App\ArtikelPopuler;
use App\Penulis_Ang_Populer;
use App\users;
use DB;

class ArtikelPopulerController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/kelolaRepository/artikelPopuler/buat') {
        return view('/artikelPopuler/buatArtikelPopuler');
      }
      else if ($route == '/kelolaRepository/artikelPopuler/kelola') {
        $dataArtikelPopuler = $this->read(); //GET ALL DATA ARTIKEL ILMIAH
        return view('/artikelPopuler/kelolaArtikelPopuler', compact('dataArtikelPopuler'));
      }
      /** FOR PAGINATION KELOLA BUKU **/
      else {
        $dataArtikelPopuler = $this->read(); //GET ALL DATA ARTIKEL ILMIAH
        return view('/artikelPopuler/kelolaArtikelPopuler', compact('dataArtikelPopuler'));
      }
    }
    else {
      return view('login');
    }
  }

  public function daftarArtikelPopuler() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      $dataArtikelPopuler = $this->read(); //GET ALL DATA ARTIKEL ILMIAH
      return view('/artikelPopuler/daftarArtikelPopuler', compact('dataArtikelPopuler'));
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
      $artikelPopuler = ArtikelPopuler::find($id); //FIND SPECIFIC MOU
      return view('/artikelPopuler/editArtikelPopuler', compact('artikelPopuler'));
    }
    else {
      return view('login');
    }
  }

  public function create(Request $request) {
    $createValidator = Validator::make($request->all(), [
      'bukti' => 'required'
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Harap Mengisi Semua Data.'); 
      return redirect('/kelolaRepository/artikelPopuler/buat'); //REDIRECT BACK TO BUAT BUKU PAGE
    }
    
    //BIKIN BUKU BARU
    $artikelPopuler = ArtikelPopuler::create($request->all());

    $filename = $request->file('bukti')->getClientOriginalName(); 
    $request->file('bukti')->move(base_path().'/public/upload/artikelPopuler', $filename);
    //UBAH FILENAME DI DATABASE
    $artikelPopuler->bukti = $filename;

    //FILL FOR TABLE PENULIS_ANGGOTA
    $list = explode(";", $request->nama_anggota);
    $count = count($list);
    for($i = 0; $i < $count; $i++) {
      $penulis_ang = new Penulis_Ang_Populer;
      $penulis_ang->id_artikel_populer = $artikelPopuler->id;
      $penulis_ang->nama_anggota = $list[$i];
      $penulis_ang->save();
    }

    $artikelPopuler->save();
    Session::flash('flash_message', $artikelPopuler->judul . ' Berhasil Dibuat'); //FLASH
    return redirect('/kelolaRepository/artikelPopuler/kelola');  
  }

  public function read() {
    $dataArtikelPopuler = ArtikelPopuler::orderBy('judul')->paginate(20);
    return $dataArtikelPopuler;
  }

  public function update(Request $request, $id) {
    $createValidator = Validator::make($request->all(), [

    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Mengubah Buku, Harap Mengisi Semua Data.'); 
      return redirect('/kelolaRepository/artikelPopuler/edit'); //REDIRECT BACK TO EDIT PRESENTASI PAGE
    }

    $checkFile = Validator::make($request->all(), [
      'bukti' => 'required'
    ]);

    //IF FILE BARU IS NULL
    $artikelPopulerNew = $request; //GET JADWAL NEW BY REQUEST USER
    $artikelPopulerOld = ArtikelPopuler::find($id); //GET JADWAL OLD BY FIND ON TABLE JADWAL_PRESETASI

    //REPLACE THE OLD WITH THE NEW ONES
    $artikelPopulerOld->judul          = $artikelPopulerNew->judul;
    $artikelPopulerOld->penulis_utama  = $artikelPopulerNew->penulis_utama;
    $artikelPopulerOld->dimuat_di      = $artikelPopulerNew->dimuat_di;
    $artikelPopulerOld->no             = $artikelPopulerNew->no;
    $artikelPopulerOld->halaman        = $artikelPopulerNew->halaman;  
    $artikelPopulerOld->tahun          = $artikelPopulerNew->tahun;    
    $artikelPopulerOld->url            = $artikelPopulerNew->url;
    $artikelPopulerOld->penerbit       = $artikelPopulerNew->penerbit;

    if ($checkFile->fails()) {
      //DO NOTHING
    }
    else{
      $filenameOld = public_path('upload/artikelPopuler/' . $artikelPopulerOld->file);
      if(File::exists($filenameOld)) {
        File::delete($filenameOld); //DELETE FILE 
      }

      //STORE NEW FILE 
      $artikelIlmiahNewName = $request->file('bukti')->getClientOriginalName(); //SIMPAN NAMA FILE
      $artikelIlmiahNew->file('bukti')->move(base_path().'/public/upload/artikelPopuler', $artikelIlmiahNewName); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $artikelIlmiahOld->bukti  = $artikelIlmiahNewName; //KEEP OLD FILE   
    }

    //FOR PENULIS ANGGOTA
    //NEW INPUT
    $list = explode(";", $request->nama_anggota);
    $countNew = count($list);

    //OLD INPUT
    $namaAnggotaOld = ArtikelPopuler::find($artikelPopulerOld->id)->getAnggota;
    $countOld = count($namaAnggotaOld);

    //CHECK INPUTAN ANGGOTA BERUBAH ATAU ENGGA
    $check = 1;
    //IF INPUTAN ANGGOTA SAMA
    if($countOld == $countNew) {
      $i = 0;
      foreach ($namaAnggotaOld as $penulis_ang) {
        if($penulis_ang->nama_anggota == $list[$i]) {
          $i = 0;
        }
        else {
          break;
        }
        $i++;
      }
    }

    //IF INPUTAN ANGGOTA PENULIS BARU KOSONG
    else if ($countNew == 0) {
      //DELETE OLD MHS TERLIBAT
      foreach ($namaAnggotaOld as $penulis_ang) {
        $penulis_ang->delete(); 
      }
      $check = 0;
    }

    //IF INPUTAN ANGGOTA TERLIBAT BERUBAH
    if ($check == 1) {
      //DELETE OLD MHS TERLIBAT
      foreach ($namaAnggotaOld as $penulis_ang) {
        $penulis_ang->delete(); 
      }
      //INPUT NEW ANGGOTA TERLIBAT
      for($i = 0; $i < $countNew; $i++) {
        $penulis_ang = new Penulis_Ang_Populer;
        $penulis_ang->id_artikel_populer = $artikelPopulerOld->id;
        $penulis_ang->nama_anggota = $list[$i];
        $penulis_ang->save();
      } 
    }

    //SIMPAN SEMUA MASUKAN DALAM BENTUK Buku
    $artikelPopulerOld->save();
    Session::flash('flash_message','Artikel Populer Berhasil Diperbarui'); //FLASH
    return redirect('/kelolaRepository/artikelPopuler/kelola');
  }

  public function delete($id) {
    $artikelPopuler = ArtikelPopuler::find($id); //FIND SPECIFIC PRESENTASI

    $filename = public_path('upload/artikelPopuler/' . $artikelPopuler->bukti); //GET SPECIFIC MOU FILE NAME
    if(File::exists($filename)) {
      File::delete($filename); //DELETE FILE FROM DIRECTORY
      $artikelPopuler->delete(); //DELETE FROM DATABASE 
      Session::flash('flash_message','Artikel Populer ' . $artikelPopuler->judul . ' Telah Dihapus');
    }

    return redirect('/kelolaRepository/artikelPopuler/kelola'); //REDIRECT BACK TO MOU PAGE
  }
}
