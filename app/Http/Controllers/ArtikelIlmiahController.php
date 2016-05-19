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
use App\ArtikelIlmiah;
use App\Penulis_Ang_Ilmiah;
use App\users;
use DB;

class ArtikelIlmiahController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/kelolaRepository/artikelIlmiah/buat') {
        return view('/artikelIlmiah/buatArtikelIlmiah');
      }
      else if ($route == '/kelolaRepository/artikelIlmiah/kelola') {
        $dataArtikelIlmiah = $this->read(); //GET ALL DATA ARTIKEL ILMIAH
        return view('/artikelIlmiah/kelolaArtikelIlmiah', compact('dataArtikelIlmiah'));
      }
      /** FOR PAGINATION KELOLA BUKU **/
      else {
        $dataArtikelIlmiah = $this->read(); //GET ALL DATA ARTIKEL ILMIAH
        return view('/artikelIlmiah/kelolaArtikelIlmiah', compact('dataArtikelIlmiah'));
      }
    }
    else {
      return view('login');
    }
  }

  public function daftarArtikelIlmiah() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      $dataArtikelIlmiah = $this->read(); //GET ALL DATA ARTIKEL ILMIAH
      return view('/artikelIlmiah/daftarArtikelIlmiah', compact('dataArtikelIlmiah'));
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
      $artikelIlmiah = ArtikelIlmiah::find($id); //FIND SPECIFIC MOU
      return view('/artikelIlmiah/editArtikelIlmiah', compact('artikelIlmiah'));
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
      return redirect('/kelolaRepository/artikelIlmiah/buat'); //REDIRECT BACK TO BUAT BUKU PAGE
    }
    
    //BIKIN BUKU BARU
    $artikelIlmiah = ArtikelIlmiah::create($request->all());

    $filename = $request->file('bukti')->getClientOriginalName(); 
    $request->file('bukti')->move(base_path().'/public/upload/artikelIlmiah', $filename);
    //UBAH FILENAME DI DATABASE
    $artikelIlmiah->bukti = $filename;

    //FILL FOR TABLE PENULIS_ANGGOTA
    $list = explode(";", $request->nama_anggota);
    $count = count($list);
    for($i = 0; $i < $count; $i++) {
      $penulis_ang = new Penulis_Ang_Ilmiah;
      $penulis_ang->id_artikel_ilmiah = $artikelIlmiah->id;
      $penulis_ang->nama_anggota = $list[$i];
      $penulis_ang->save();
    }

    $artikelIlmiah->save();
    Session::flash('flash_message', $artikelIlmiah->judul . ' Berhasil Dibuat'); //FLASH
    return redirect('/kelolaRepository/artikelIlmiah/kelola');  
  }

  public function read() {
    $dataArtikelIlmiah = ArtikelIlmiah::orderBy('judul')->paginate(20);
    return $dataArtikelIlmiah;
  }

  public function update(Request $request, $id) {
    $createValidator = Validator::make($request->all(), [

    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Mengubah Buku, Harap Mengisi Semua Data.'); 
      return redirect('/kelolaRepository/artikelIlmiah/edit'); //REDIRECT BACK TO EDIT PRESENTASI PAGE
    }

    $checkFile = Validator::make($request->all(), [
      'bukti' => 'required'
    ]);

    //IF FILE BARU IS NULL
    $artikelIlmiahNew = $request; //GET JADWAL NEW BY REQUEST USER
    $artikelIlmiahOld = ArtikelIlmiah::find($id); //GET JADWAL OLD BY FIND ON TABLE JADWAL_PRESETASI

    //REPLACE THE OLD WITH THE NEW ONES
    $artikelIlmiahOld->judul          = $artikelIlmiahNew->judul;
    $artikelIlmiahOld->penulis_utama  = $artikelIlmiahNew->penulis_utama;
    $artikelIlmiahOld->nama_jurnal    = $artikelIlmiahNew->nama_jurnal;
    $artikelIlmiahOld->level          = $artikelIlmiahNew->level;
    $artikelIlmiahOld->issn           = $artikelIlmiahNew->issn;
    $artikelIlmiahOld->no             = $artikelIlmiahNew->no;
    $artikelIlmiahOld->volume         = $artikelIlmiahNew->volume;
    $artikelIlmiahOld->tahun          = $artikelIlmiahNew->tahun;    
    $artikelIlmiahOld->halaman        = $artikelIlmiahNew->halaman;  
    $artikelIlmiahOld->url            = $artikelIlmiahNew->url;
    $artikelIlmiahOld->penerbit       = $artikelIlmiahNew->penerbit;

    if ($checkFile->fails()) {
      //DO NOTHING
    }
    else{
      $filenameOld = public_path('upload/artikelIlmiah/' . $artikelIlmiahOld->file);
      if(File::exists($filenameOld)) {
        File::delete($filenameOld); //DELETE FILE 
      }

      //STORE NEW FILE 
      $artikelIlmiahNewName = $request->file('bukti')->getClientOriginalName(); //SIMPAN NAMA FILE
      $artikelIlmiahNew->file('bukti')->move(base_path().'/public/upload/artikelIlmiah', $artikelIlmiahNewName); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $artikelIlmiahOld->bukti  = $artikelIlmiahNewName; //KEEP OLD FILE   
    }

    //FOR PENULIS ANGGOTA
    //NEW INPUT
    $list = explode(";", $request->nama_anggota);
    $countNew = count($list);

    //OLD INPUT
    $namaAnggotaOld = ArtikelIlmiah::find($artikelIlmiahOld->id)->getAnggota;
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
        $penulis_ang = new Penulis_Ang_Ilmiah;
        $penulis_ang->id_artikel_ilmiah = $artikelIlmiahOld->id;
        $penulis_ang->nama_anggota = $list[$i];
        $penulis_ang->save();
      } 
    }

    //SIMPAN SEMUA MASUKAN DALAM BENTUK Buku
    $artikelIlmiahOld->save();
    Session::flash('flash_message','Buku Berhasil Diperbarui'); //FLASH
    return redirect('/kelolaRepository/artikelIlmiah/kelola');
  }

  public function delete($id) {
    $artikelIlmiah = ArtikelIlmiah::find($id); //FIND SPECIFIC PRESENTASI

    $filename = public_path('upload/artikelIlmiah/' . $artikelIlmiah->bukti); //GET SPECIFIC MOU FILE NAME
    if(File::exists($filename)) {
      File::delete($filename); //DELETE FILE FROM DIRECTORY
      $artikelIlmiah->delete(); //DELETE FROM DATABASE 
      Session::flash('flash_message','Artikel Ilmiah ' . $artikelIlmiah->judul . ' Telah Dihapus');
    }

    return redirect('/kelolaRepository/artikelIlmiah/kelola'); //REDIRECT BACK TO MOU PAGE
  }
}
