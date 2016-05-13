<?php

namespace App\Http\Controllers;
use App\Laporan;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;
use DB;
use Session;
use Validator;

class LaporanController extends Controller {
 
  public function index() {
		//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      $id = $_SESSION['id'];
      $proposals = DB::table('proposal')->where('dosen', '=', $id)->get();
      $laporanAkhir = DB::table('laporan')
      ->where('dosen', '=', $id)
      ->where('file_akhir', '=', '')
      ->get();

      if ($route == '/laporan/laporanKemajuan') {
          return view('/laporan/laporanKemajuan', compact('proposals'));
      }
      else if ($route == '/laporan/laporanAkhir') {
          return view('/laporan/laporanAkhir', compact('laporanAkhir'));
      }
    } 
    else {
        return view('login');
    }
  }   

  public function laporankemajuan() {  
		//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        $allKemajuan = DB::table('laporan')
        ->join('users', 'laporan.dosen', '=', 'users.id')
        ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
        ->join('hibah', 'proposal.id_hibah', '=', 'hibah.id')
        ->where('tipe_progres', '=', 'kemajuan')
        ->select('laporan.*', 'users.nama', 'hibah.nama_hibah')
        ->get();
        return view('/laporan/readLaporanKemajuan', compact('allKemajuan'));
    }
    else {
        return view('login');
    }
  }

  public function laporanakhir() {  
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        $allAkhir = DB::table('laporan')
        ->join('users', 'laporan.dosen', '=', 'users.id')
        ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
        ->join('hibah', 'proposal.id_hibah', '=', 'hibah.id')
        ->where('tipe_progres', '=', 'akhir')
        ->select('laporan.*', 'users.nama', 'hibah.nama_hibah')
        ->get();
        return view('/laporan/readLaporanAkhir', compact('allAkhir'));
    }
    else {
        return view('login');
    }
  }     

  public function uploadKemajuan($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        $proposal = Proposal::find($id);
        if(!$proposal){ 
          abort(404);
        } 
        else {
          return view('/laporan/uploadLaporanKemajuan', compact('proposal'));
        }
    }
    else {
        return view('login');
    }
  }   

  public function uploadLaporanKemajuanStore(Request $request, $id) {
    $this->validate($request, [
        'file_kemajuan' => 'required'
    ]);

    $msg= Laporan::create($request->all());
    $filename = $request->file('file_kemajuan')->getClientOriginalName();
    $request->file('file_kemajuan')->move(base_path().'/public/upload/laporanKemajuan', $filename);
    $msg->file_kemajuan = $filename;
    $msg->save();
    Session::flash('flash_message','Upload laporan kemajuan berhasil dilakukan'); //FLASH MESSAGE
    return redirect('/laporan/laporanKemajuan');
  }

  public function uploadLaporanAkhir($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        $laporanAkhir = Laporan::find($id);
        if(!$laporanAkhir){ 
          abort(404);
        } 
        else {
          return view('/laporan/uploadLaporanAkhir', compact('laporanAkhir'));
        }
    }
    else {
        return view('login');
    }
  }

  public function uploadLaporanAkhirStore(Request $request, $id) {
    $updateValidator = Validator::make($request->all(), [
      'file_akhir' => 'required'
    ]);

    $akhirNew = $request; //GET HIBAH NEW BY REQUEST USER
    $akhirOld = Laporan::find($id); //GET HIBAH OLD BY FIND ON TABLE HIBAH

    //VALIDATOR JIKA JUDUL MOU DAN/ATAU NAMA PENELITI TIDAK DIISI
    if ($updateValidator->fails()) {
      $akhirOld->file_akhir = $akhirOld->file_akhir; //KEEP OLD FILE
      Session::flash('flash_message', 'Harap Melampirkan file laporan Akhir!'); //nampilin kalo sukses
    } 
    else {
      $akhirOld->tipe_progres = $akhirNew->tipe_progres;
      $filename = $akhirNew->file('file_akhir')->getClientOriginalName();
      $request->file('file_akhir')->move(base_path().'/public/upload/laporanAkhir', $filename);
      $akhirOld->file_akhir = $filename;
      $akhirOld->save();
      Session::flash('flash_message','Upload laporan Akhir berhasil dilakukan'); //FLASH MESSAGE

      /* TO BE KALO PENGEN BISA REVISI LAPORAN 
      //DELETE THE OLD FILES IN FOLDER MOU
      $akhirNameOld = public_path('upload/laporankemajuan/' . $akhirOld->file_akhir); //GET SPECIFIC OLD FOTO NAME
      if(File::exists($akhirNameOld)) {
          File::delete($akhirNameOld); //DELETE FILE FROM FOLDER FOTO KONTAK
      }
      //STORE NEW FOTO TO FOLDER MOU
      $kontakNewFoto = $kontakNew->id . '_' . $kontakNew->nama . '.' . 
        $request->file('foto')->getClientOriginalExtension(); //SIMPAN NAMA FILE
      $kontakNew->file('foto')->move(base_path().'/public/upload/fotoKontak', $kontakNewFoto); //SIMPAN MOU KE SUATU FOLDER

      //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
      $kontakOld->foto  = $kontakNewFoto;
      */
    }

    return redirect('/laporan/laporanAkhir'); //REDIRECT TO LAPORAN AKHIR PAGE     
  }      

}
