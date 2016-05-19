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
      $laporanKemajuan = DB::table('laporan')
      ->where('dosen', '=', $id)
      ->where('flag_kemajuan', '=', '1')
      ->get();

      if ($route == '/laporan/laporanKemajuan') {
          return view('/laporan/laporanKemajuan', compact('proposals'));
      }
      else if ($route == '/laporan/laporanAkhir') {
          return view('/laporan/laporanAkhir', compact('laporanKemajuan','proposals'));
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
    $idRole = $SSOController->getId(); // get id dosen / staf
    $getSpesifikRole = $SSOController->getSpesifikRole(); // dapetin rolenya
    if($check) {
      // tampilan di staf riset nampilin semua proposal
      if($getSpesifikRole == 'divisi riset'){
        $allKemajuan = DB::table('laporan')
        ->join('users', 'laporan.dosen', '=', 'users.id')
        ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
        ->join('hibah', 'proposal.id_hibah', '=', 'hibah.id')
        ->where('tipe_progres', '=', 'kemajuan')
        ->select('laporan.*', 'users.nama', 'hibah.nama_hibah')
        ->paginate(20);
        return view('/laporan/readlaporankemajuan', compact('allKemajuan'));
      }
      else if($getSpesifikRole == 'dosen'){
        $allKemajuan = DB::table('laporan')
        ->join('users', 'laporan.dosen', '=', 'users.id')
        ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
        ->join('hibah', 'proposal.id_hibah', '=', 'hibah.id')
        ->where('tipe_progres', '=', 'kemajuan')
        ->where('laporan.dosen', '=', $idRole)
        ->select('laporan.*', 'users.nama', 'hibah.nama_hibah')
        ->paginate(20);
        return view('/laporan/readlaporankemajuan', compact('allKemajuan'));
      }
    }
    else {
        return view('login');
    }
  }

  public function laporanakhir() {  
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    $idRole = $SSOController->getId(); // get id dosen / staf
    $getSpesifikRole = $SSOController->getSpesifikRole(); // dapetin rolenya
    if($check) {
      if($getSpesifikRole == 'divisi riset'){
        $allAkhir = DB::table('laporan')
        ->join('users', 'laporan.dosen', '=', 'users.id')
        ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
        ->join('hibah', 'proposal.id_hibah', '=', 'hibah.id')
        ->where('tipe_progres', '=', 'akhir')
        ->select('laporan.*', 'users.nama', 'hibah.nama_hibah')
        ->paginate(20);
        return view('/laporan/readLaporanAkhir', compact('allAkhir'));
      }
      else if($getSpesifikRole == 'dosen'){
        $allAkhir = DB::table('laporan')
        ->join('users', 'laporan.dosen', '=', 'users.id')
        ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
        ->join('hibah', 'proposal.id_hibah', '=', 'hibah.id')
        ->where('tipe_progres', '=', 'akhir')
        ->where('laporan.dosen', '=', $idRole)
        ->select('laporan.*', 'users.nama', 'hibah.nama_hibah')
        ->paginate(20);
        return view('/laporan/readLaporanAkhir', compact('allAkhir'));
      }
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

    // get semua laporan terkait proposal dengan id proposal
    $laporanOld = DB::table('laporan')
          ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
          ->where('laporan.id_proposal', '=',$id)
          ->select('laporan.*')
          ->get();
    
    // ubah nilai laporan yang lama flag nya
    foreach($laporanOld as $laporan){
      if($laporan->flag_kemajuan == 1){
        $id = $laporan->id; // id laporan yang mau diubah nilianya
        $laporantemp = Laporan::find($id);
        $laporantemp->flag_kemajuan = 0;
        $laporantemp->save();
      }
    }

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

    //VALIDATOR JIKA JUDUL MOU DAN/ATAU NAMA PENELITI TIDAK DIISI
    if ($updateValidator->fails()) {
      Session::flash('flash_message', 'Harap Melampirkan file laporan Akhir!'); //nampilin kalo sukses
    } 
    else {
    // get semua laporan terkait proposal dengan id proposal
    
    $laporan = Laporan::find($id);
    $laporanOld = DB::table('laporan')
          ->join('proposal', 'laporan.id_proposal', '=', 'proposal.id')
          ->where('proposal.id', '=', $laporan->id_proposal)
          ->select('laporan.*')
          ->get();
    
    // ubah nilai laporan yang lama flag nya
    foreach($laporanOld as $laporan){
      if($laporan->flag_akhir == 1){
        $id = $laporan->id; // id laporan yang mau diubah nilianya
        $laporantemp = Laporan::find($id);
        $laporantemp->flag_akhir = 0;
        $laporantemp->save();
      }
    }
      $msg= Laporan::create($request->all()); 
      $filename = $request->file('file_akhir')->getClientOriginalName();
      $request->file('file_akhir')->move(base_path().'/public/upload/laporanAkhir', $filename);
      $msg->file_akhir = $filename;
      $msg->save();
      Session::flash('flash_message','Upload laporan Akhir berhasil dilakukan'); //FLASH MESSAGE
    }

    return redirect('/laporan/laporanAkhir'); //REDIRECT TO LAPORAN AKHIR PAGE     
  }      

}
