<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePesanFormRequest;
use Session;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;
use App\Pesan;
use App\users;

class PesanController extends Controller
{
  public function index() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $users = users::where('spesifik_role','dosen')->get(); //dapetin semua user yg spesifik role nya dosen
    $id = $SSOController->getId(); // ngambil id dari sso, liat methodnya di pesan model
    $spesifik_role = $SSOController->getSpesifikRole(); // ambil spesifik role dr user, liat methodnya di pesan model

    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      if($route == "/pesan/buat") {
        return view('/pesan/buatPesan', compact('users'));
      }
      else {
        $messages = Pesan::where('id_pengirim', $id)->paginate(50);
        return view('/pesan/daftarPesanRiset',compact('users','messages')); 
      }
    }
    else {
        return view('login');
    }
  }

  public function daftarPesanDosen() {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    
    $users = users::where('spesifik_role','dosen')->get(); //GET ALL USER = DOSEN
    $id = $SSOController->getId(); // ngambil id dari sso, liat methodnya di pesan model

    if($check) {
      $messages = Pesan::where('penerima', $id)->paginate(50);
      return view('/pesan/daftarPesanDosen',compact('users','messages')); 
    }
    else {
        return view('login');
    }
  }

  //METHOD STORE PESAN KE DATABASE
  public function kirim(CreatePesanFormRequest $request) {
    //BIKIN PESAN BARU
    if($request->hasFile('file')){
        $msg = Pesan::create($request->all());
        //untuk upload file, request file dengan segala extensi
        $filename = $request->file('file')->getClientOriginalName();
        //memindahkan file yg dilampirkan tadi ke path /public/upload
        $request->file('file')->move(base_path().'/public/upload/pesan', $filename);
        $msg->file = $filename;
        //SAVE FILEnya
        $msg->save();
    } else {
         $msg = Pesan::create($request->all());
         $msg->file = null;
         $msg->save();
    }
    
    // Session untuk Success Notif
    Session::flash('flash_message','Pesan berhasil terkirim!');
    // then rederict back to pesan
    return redirect('/daftarPesanRiset');
  }

  public function detailPesan($id){
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

    if ($check) {
      $message = Pesan::find($id);
      return view('/pesan/detailPesan',compact('message'));
    }
  }

  public function readPesan($id){
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

    if ($check) {
      $message = Pesan::find($id);
      if ($message->isread == 0) {
        $message->isread = 1;
        $message->save();

        //KURANGIN TOTAL MESSAGE
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $_SESSION['countPesan'] = $SSOController->totalMessage($_SESSION['id']);
      }
      return view('/pesan/detailPesan',compact('message'));
    }
  }
}
