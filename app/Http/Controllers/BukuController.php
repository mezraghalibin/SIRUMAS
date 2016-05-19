<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Validator;
use File;
use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\SSOController;
use App\Buku;
use App\users;
use App\Penulis_Ang_Buku;
use DB;

class BukuController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/kelolaRepository/buku/buat') {
        return view('/buku/buatBuku');
      }
      else {
        $dataBuku = $this->read(); //GET ALL DATA HIBAH
        return view('/buku/kelolaBuku', compact('dataBuku'));
      }
    }
    else {
      return view('login');
    }
  }

  public function daftarBuku() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      $dataBuku = $this->read(); //GET ALL DATA HIBAH
      return view('/buku/daftarBuku', compact('dataBuku'));
    }
    else {
      return view('login');
    }
  }

  public function read() {
    $dataBuku = Buku::orderBy('judul')->paginate(20);
    return $dataBuku;
  }

  public function store(Request $request) {
    $createValidator = Validator::make($request->all(), [
      'file' => 'required'
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Harap Mengisi Semua Data.'); 
      return redirect('/kelolaRepository/buku/buat'); //REDIRECT BACK TO BUAT BUKU PAGE
    }
    
    //BIKIN BUKU BARU
    $buku = Buku::create($request->all());

    $filename = $request->file('file')->getClientOriginalName(); 
    $request->file('file')->move(public_path('/upload/buku'), $filename);
    //UBAH FILENAME DI DATABASE
    $buku->sampul = $filename;

    //FILL FOR TABLE PENULIS_ANGGOTA
    $list = explode(";", $request->nama_anggota);
    $count = count($list);
    for($i = 0; $i < $count; $i++) {
      $penulis_ang = new Penulis_Ang_Buku;
      $penulis_ang->id_buku = $buku->id;
      $penulis_ang->nama_anggota = $list[$i];
      $penulis_ang->save();
    }

    $buku->save();
    Session::flash('flash_message', $buku->judul . ' Berhasil Dibuat'); //FLASH
    return redirect('/kelolaRepository/buku/kelola');         
  }

  public function edit($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    if ($check) {
      $buku = Buku::find($id); //FIND SPECIFIC MOU
      return view('/buku/editBuku', compact('buku'));
    }
    else {
      return view('login');
    }
  }

  public function update(Request $request, $id) {
    $createValidator = Validator::make($request->all(), [

    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Mengubah Buku, Harap Mengisi Semua Data.'); 
      return redirect('/kelolaRepository/buku/edit'); //REDIRECT BACK TO EDIT PRESENTASI PAGE
    }

    $checkFile = Validator::make($request->all(), [
      'file' => 'required'
    ]);

    //IF FILE BARU IS NULL
    $bukuNew = $request; //GET JADWAL NEW BY REQUEST USER
    $bukuOld = Buku::find($id); //GET JADWAL OLD BY FIND ON TABLE JADWAL_PRESETASI

    //REPLACE THE OLD WITH THE NEW ONES
    $bukuOld->judul       = $bukuNew->judul;
    $bukuOld->penulis     = $bukuNew->penulis;
    $bukuOld->penerbit    = $bukuNew->penerbit;
    $bukuOld->isbn        = $bukuNew->isbn;
    $bukuOld->tahun       = $bukuNew->tahun;    
    $bukuOld->jumlah_hlm  = $bukuNew->jumlah_hlm;  
    $bukuOld->kota_terbit = $bukuNew->kota_terbit;      

    if ($checkFile->fails()) {
      //DO NOTHING
    }
    else{
      $filenameOld = public_path('upload/buku/' . $bukuOld->file);
      if(File::exists($filenameOld)) {
        File::delete($filenameOld); //DELETE FILE 
      }

      //STORE NEW FILE 
      $bukuNewName = $request->file('file')->getClientOriginalName(); //SIMPAN NAMA FILE
      $bukuNew->file('file')->move(base_path().'/public/upload/buku', $bukuNewName); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $bukuOld->file  = $bukuNewName; //KEEP OLD FILE   
    }

    //FOR PENULIS ANGGOTA
    //NEW INPUT
    $list = explode(";", $request->nama_anggota);
    $countNew = count($list);

    //OLD INPUT
    $namaAnggotaOld = Buku::find($bukuOld->id)->getPenulis;
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
        $penulis_ang = new Penulis_Ang_Buku;
        $penulis_ang->id_buku = $bukuOld->id;
        $penulis_ang->nama_anggota = $list[$i];
        $penulis_ang->save();
      } 
    }

    //SIMPAN SEMUA MASUKAN DALAM BENTUK Buku
    $bukuOld->save();
    Session::flash('flash_message','Buku Berhasil Diperbarui'); //FLASH
    return redirect('kelolabuku');
  }

  public function delete($id) {
    $buku = Buku::find($id); //FIND SPECIFIC PRESENTASI
    Session::flash('flash_message','Buku ' . $buku->judul . ' Telah Dihapus');

    $filename = public_path('upload/buku/' . $buku->sampul); //GET SPECIFIC MOU FILE NAME
    if(File::exists($filename)) {
      File::delete($filename); //DELETE FILE FROM DIRECTORY
      $buku->delete(); //DELETE FROM DATABASE 
    }

    return redirect('/kelolaRepository/buku/kelola'); //REDIRECT BACK TO MOU PAGE
  }
}
