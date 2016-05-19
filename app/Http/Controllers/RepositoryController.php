<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Buku;
use App\ArtikelIlmiah;
use App\ArtikelPopuler;
use App\Penelitian;
use App\Pengmas;
use App\KegiatanIlmiah;
use Session;
use Validator;
use DB;

class RepositoryController extends Controller
{
  public function index()
  {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN(); 

    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      if ($route == '/repository') {
        return view('/repository/repository');
      }
      else if ($route == '/kelolaRepository') {
        return view('repository/kelolaRepository');
      }
    }
    else {
      return view('login');
    }
  }

  public function halamanSearch() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN(); 

    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      return view('searchKelolaRepo');
    }
    else {
      return view('login');
    }
  }

  public function searchPublikasi(Request $request) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN(); 

    if ($check) {
      //IF ALL INPUT IS EMPTY
      $count = count($request->all());
      if ($request->judul == "" && $request->penulis == "" && $request->penerbit == ""
        && $request->tahun == "" && $request->anggota == "") {
        //FLASH MESSAGE IF FAILS
        Session::flash('flash_message','Silahkan mengisi form untuk mencari data!'); 
        return redirect('/kelolaRepository');
      }

      //SEARCH BUKU
      $dataBuku = Buku::join('penulis_ang_buku', 'buku.id', '=', 'penulis_ang_buku.id_buku')
        ->select('buku.id', 'judul', 'penulis', 'penerbit', 'isbn', 'tahun', 'sampul', 'jumlah_hlm', 'kota_terbit')
        ->where('judul', 'like', '%' . $request->judul . '%') 
        ->where('penulis', 'like', '%' . $request->penulis . '%') 
        ->where('penerbit', 'like', '%' . $request->penerbit . '%') 
        ->where('tahun', 'like', '%' . $request->tahun . '%')
        ->where('penulis_ang_buku.nama_anggota', 'like', '%' . $request->anggota . '%')
        ->distinct()
        ->orderBy('judul')
        ->get();

      //SEARCH ARTIKEL ILMIAH
      $dataArtikelIlmiah = ArtikelIlmiah::join('penulis_ang_ilmiah', 'artikel_ilmiah.id', '=', 'penulis_ang_ilmiah.id_artikel_ilmiah')
        ->select('artikel_ilmiah.id', 'judul', 'penulis_utama', 'nama_jurnal', 'level', 'penerbit', 'issn', 
          'no', 'volume', 'tahun', 'halaman', 'url')
        ->where('judul', 'like', '%' . $request->judul . '%') 
        ->where('penulis_utama', 'like', '%' . $request->penulis . '%') 
        ->where('penerbit', 'like', '%' . $request->penerbit . '%') 
        ->where('tahun', 'like', '%' . $request->tahun . '%')
        ->where('penulis_ang_ilmiah.nama_anggota', 'like', '%' . $request->anggota . '%')
        ->distinct()
        ->orderBy('judul')
        ->get();

      //SEARCH ARTIKEL POPULER
      $dataArtikelPopuler = ArtikelPopuler::join('penulis_ang_populer', 'artikel_populer.id', '=', 'penulis_ang_populer.id_artikel_populer')
        ->select('artikel_populer.id', 'judul', 'penulis_utama', 'dimuat_di', 'penerbit', 'no', 'tahun', 'halaman', 'url')
        ->where('judul', 'like', '%' . $request->judul . '%') 
        ->where('penulis_utama', 'like', '%' . $request->penulis . '%') 
        ->where('penerbit', 'like', '%' . $request->penerbit . '%') 
        ->where('tahun', 'like', '%' . $request->tahun . '%')
        ->where('penulis_ang_populer.nama_anggota', 'like', '%' . $request->anggota . '%')
        ->distinct()
        ->orderBy('judul')
        ->get();

      $kategori = "publikasi";
      return view('/searchKelolaRepo', compact('dataBuku', 'dataArtikelIlmiah', 'dataArtikelPopuler', 'kategori'));
    }
  }

  public function searchKegiatan(Request $request) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN(); 

    if ($check) {
      //IF ALL INPUT IS EMPTY
      $count = count($request->all());
      if ($request->judul == "" && $request->ketua == "" && $request->pembicara == "") {
        //FLASH MESSAGE IF FAILS
        Session::flash('flash_message','Silahkan mengisi form untuk mencari data!'); 
        return redirect('/kelolaRepository');
      }

      $dataPenelitian = "";
      $dataPengmas = "";
      $dataKegiatanIlmiah = "";

      //IF FORM PEMBICARA GA KOSONG DAN FORM KETUA KOSONG
      if ($request->ketua == "" && $request->pembicara != "") {
        //SEARCH KEGIATAN ILMIAH
        $dataKegiatanIlmiah = KegiatanIlmiah::where('nama', 'like', '%' . $request->judul . '%') 
          ->where('pembicara', 'like', '%' . $request->pembicara . '%')
          ->distinct()
          ->orderBy('nama')
          ->get();
      }

      //IF FORM PEMBICARA KOSONG DAN FORM KETUA GA KOSONG
      else if($request->ketua != "" && $request->pembicara == "") {
        //SEARCH PENELITIAN
        $dataPenelitian = Penelitian::where('judul', 'like', '%' . $request->judul . '%') 
          ->where('ketua', 'like', '%' . $request->ketua . '%') 
          ->distinct()
          ->orderBy('judul')
          ->get();

        //SEARCH PENGMAS
        $dataPengmas = Pengmas::where('nama_kegiatan', 'like', '%' . $request->judul . '%') 
          ->where('ketua', 'like', '%' . $request->ketua . '%') 
          ->distinct()
          ->orderBy('nama_kegiatan')
          ->get();
      }

      else {
        //SEARCH PENELITIAN
        $dataPenelitian = Penelitian::where('judul', 'like', '%' . $request->judul . '%') 
          ->where('ketua', 'like', '%' . $request->ketua . '%') 
          ->distinct()
          ->orderBy('judul')
          ->get();

        //SEARCH PENGMAS
        $dataPengmas = Pengmas::where('nama_kegiatan', 'like', '%' . $request->judul . '%') 
          ->where('ketua', 'like', '%' . $request->ketua . '%') 
          ->distinct()
          ->orderBy('nama_kegiatan')
          ->get();

        //SEARCH KEGIATAN ILMIAH
        $dataKegiatanIlmiah = KegiatanIlmiah::where('nama', 'like', '%' . $request->judul . '%') 
          ->where('pembicara', 'like', '%' . $request->pembicara . '%')
          ->distinct()
          ->orderBy('nama')
          ->get();
      }

      $kategori = "kegiatan";
      return view('/searchKelolaRepo', compact('dataPenelitian', 'dataPengmas', 'dataKegiatanIlmiah', 'kategori'));
    }
  }
}
