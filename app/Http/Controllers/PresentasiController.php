<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Http\Requests;
use App\Laporan;
use App\Users;
use App\Http\Response;
use App\Http\Controllers\SSOController;
use DB;
use App\JadwalPresentasi;
use App\Http\Controllers\FunctionController;
use App\Kontak;

class PresentasiController extends Controller {
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if ($check) {
      if($route == '/presentasi/buatpresentasi') {
        $dataLaporan = $this->getLaporan();
        $dataKontak = Kontak::all();
        return view('/presentasi/buatpresentasi', compact('dataLaporan', 'dataKontak'));
      }
      else if ($route == '/presentasi/kelolapresentasi') {
        $dataPresentasi = $this->getPresentasi(); //GET ALL DATA HIBAH
        return view('/presentasi/kelolapresentasi', compact('dataPresentasi'));
      }
    }
    else {
      return view('login');
    }
  }

  public function store(Request $request) {
    $createValidator = Validator::make($request->all(), [
      'reviewer' => 'required',
      'waktu' => 'required',
      'waktu_akhir' => 'required',
      'gedung' => 'required',
      'ruang' => 'required'
    ]);

    //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
    if ($createValidator->fails()) {
      //FLASH MESSAGE IF FAILS
      Session::flash('flash_message','Gagal Membuat Jadwal Presentasi, Harap Mengisi Semua Data.'); 
      return redirect('/presentasi/buatpresentasi'); //REDIRECT BACK TO BUAT KONTAK PAGE
    }

    $check = $this->check($request);
    if ($check == true) {
      $function = new FunctionController(); 
      $presentasi = JadwalPresentasi::create($request->all()); //SIMPAN SEMUA MASUKAN DALAM BENTUK KONTAK
      $presentasi->tanggal = $function->string_to_date($presentasi->tanggal);
      $presentasi->save();
      Session::flash('flash_message','Jadwal Presentasi Berhasil Dibuat'); //FLASH
    } 
    else {
      Session::flash('flash_message','Gagal Membuat, Jadwal Presentasi Sudah Ada');
    }
    return redirect('/presentasi/kelolapresentasi'); //REDIRECT BACK TO BUAT KONTAK PAGE
  }

    // fungsi buat ngecheck udah ada apa belom jadwal presentasi atas nama laporan
  public function check($request) {
    // cek ada ngga si nama laporan itu di tabel presentasi
    $function = new FunctionController(); 
    $tanggal = $function->string_to_date($request->tanggal);
    $dataLaporan = DB::table('jadwal_presentasi')
        ->select('jadwal_presentasi.*')
        ->where('jadwal_presentasi.id_laporan', '=', $request->id_laporan)
        ->where('jadwal_presentasi.waktu', '=', $request->waktu , 'and', 'jadwal_presentasi.waktu_akhir', '=',$request->waktu_akhir)
        ->where('jadwal_presentasi.tanggal' , '=', $tanggal)
        ->get();
    // kalau gaada isi
    if(count($dataLaporan) == 0) {
      return true;
    }
    else {
      return false;
    } 
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
        if ($check) {
          $data = JadwalPresentasi::find($id); //FIND SPECIFIC MOU
          $id_laporan = $data->id_laporan;
          $dataPresentasi = DB::table('jadwal_presentasi')
            ->join('laporan', 'jadwal_presentasi.id_laporan', '=', 'laporan.id')
            ->select('jadwal_presentasi.*', 'laporan.judul')
            ->where('laporan.id', '=',$id_laporan)
            ->get();
          return view('/presentasi/editpresentasi', compact('dataPresentasi'));
        }
        else {
          return view('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $createValidator = Validator::make($request->all(), [
          'reviewer' => 'required',
          'waktu' => 'required',
          'gedung' => 'required',
          'ruang' => 'required'
        ]);

        //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
        if ($createValidator->fails()) {
          //FLASH MESSAGE IF FAILS
          Session::flash('flash_message','Gagal Mengubah Jadwal Presentasi, Harap Mengisi Semua Data.'); 
          return redirect('/presentasi/kelolapresentasi'); //REDIRECT BACK TO EDIT PRESENTASI PAGE
        }

        $presentasiNew = $request; //GET JADWAL NEW BY REQUEST USER
        $presentasiOld = JadwalPresentasi::find($id); //GET JADWAL OLD BY FIND ON TABLE JADWAL_PRESETASI
        $check = $this->check($presentasiNew);
        if($check== true){
            //REPLACE THE OLD WITH THE NEW ONES
          $presentasiOld->id_laporan = $presentasiNew->id_laporan;
          $presentasiOld->waktu = $presentasiNew->waktu;
          $function = new FunctionController(); 
          $presentasiOld->tanggal = $function->string_to_date($request->tanggal);
          $presentasiOld->status = $presentasiNew->status;
          $presentasiOld->reviewer = $presentasiNew->reviewer;
          $presentasiOld->ruang = $presentasiNew->ruang;
          $presentasiOld->gedung = $presentasiNew->gedung;
          $presentasiOld->staf_riset = $presentasiNew->staf_riset;    

          //SIMPAN SEMUA MASUKAN DALAM BENTUK KONTAK
          $presentasiOld->save();
          Session::flash('flash_message','Jadwal Presentasi Berhasil Diperbarui'); //FLASH
        } else {
          Session::flash('flash_message','Gagal Memperbarui, Jadwal Presentasi Sudah Ada');
        }
        return redirect('/presentasi/kelolapresentasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $presentasi = JadwalPresentasi::find($id); //FIND SPECIFIC PRESENTASI
        Session::flash('flash_message','Jadwal Presentasi untuk laporan' . $presentasi->judul . ' Telah Dihapus');
        $presentasi->delete(); //DELETE FROM DATABASE 
        return redirect('/presentasi/kelolapresentasi'); //REDIRECT BACK TO MOU PAGE
    }

    public function getLaporan()
    {
        $dataLaporan = DB::table('laporan')
            ->join('users', 'laporan.dosen', '=', 'users.id')
            ->select('laporan.*', 'users.nama')
            ->where('laporan.flag_akhir', '=', 1)
            ->get();
        return $dataLaporan;
    }

    public function getPresentasi(){
        $dataPresentasi = DB::table('jadwal_presentasi')
            ->join('laporan', 'jadwal_presentasi.id_laporan', '=', 'laporan.id')
            ->join('users', 'laporan.dosen', '=', 'users.id')
            ->select('jadwal_presentasi.*', 'users.nama', 'laporan.judul')
            ->get();
        return $dataPresentasi;
    }
}
