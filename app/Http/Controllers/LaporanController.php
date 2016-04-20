<?php

namespace App\Http\Controllers;
use App\Laporan;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;
use DB;
use Session;

class LaporanController extends Controller {
 
  public function index() {
		//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        //$proposals = DB::table('proposal')->get();
        $id = $_SESSION['id'];
        $proposals = DB::table('proposal')->where('dosen', '=', $id)->get();
        return view('laporan', ['proposals' => $proposals]);
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
        return view('laporankemajuan');
    }
    else {
        return view('login');
    }
  }   

  public function uploadkemajuan($id) {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        $proposal = Proposal::find($id);
        if(!$proposal){ 
          abort(404);
        } 
        else {
          return view('uploadkemajuan')->with('proposal',$proposal);
        }
        
    }
    else {
        return view('login');
    }
  }   

  public function uploadkemajuanstore(Request $request, $id) {
     $this->validate($request, [
            'file' => 'required'
        ]);
  
    
      $msg=\App\Laporan::create($request->all());
      $filename = $request->file('file')->getClientOriginalName();
      $request->file('file')->move(base_path().'/public/upload/laporankemajuan', $filename);
      $msg->file = $filename;
      $msg->save();
      Session::flash('flash_message','Upload laporan kemajuan berhasil dilakukan'); //FLASH MESSAGE
      return redirect('laporan');
    
  }

  public function uploadlaporanberhibah() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        return view('uploadlaporanberhibah');
    }
    else {
        return view('login');
    }
  }   

  public function uploadlaporantdkberhibah() {
		//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        return view('uploadlaporantdkberhibah');
    }
    else {
        return view('login');
    }
  }   
}
