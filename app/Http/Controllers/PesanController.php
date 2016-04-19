<?php

namespace App\Http\Controllers;

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
      $a = $SSOController->getId(); // ngambil id dari sso, liat methodnya di pesan model
      $b = $SSOController->getSpesifikRole(); // ambil spesifik role dr user, liat methodnya di pesan model
      // jika spesifik role nya adalah divisi riset, munculin pesan mana aja yang pernah dikirim oleh dirinya
      if($b == 'divisi riset'){
          $messages = Pesan::where('id_pengirim', $a)->get();
      // jika spesifik rolenya dosen, munculin pesan yg diterima oleh dosen ybs
      } else {
          $messages = Pesan::where('penerima', $a)->get();
      }

      // pass variable users, messaged to pesan.blade
      if($check) {
          return view('pesan',compact('users','messages')); //ngirim var user
      }
      else {
          return view('login');
      }
  }
  
  // INI KALO MAU SEMUA DIVISI RISET BISA LIAT SEMUA PESAN, DI UNCOMMENT AJA INI SAMA JOIN TABLE KALO MAU MAKE
  // public function index() {
  //     //CHECK IF USER IS LOGGED IN OR NOT
  //     $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
  //     $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
      
  //     $users = users::where('spesifik_role','dosen')->get(); //dapetin semua user yg spesifik role nya dosen
  //     $a = $SSOController->getId(); // ngambil id dari sso, liat methodnya di pesan model
  //     $b = $SSOController->getSpesifikRole(); // ambil spesifik role dr user, liat methodnya di pesan model
      
  //     // IF SPESIFIK ROLE = DIVISI RISET, MUNCULKAN SEMUA PESAN YANG DIKIRIM DIVISI RISET
  //     if($b == 'divisi riset'){
  //         $messages = $this->joinTable();
  //     // IF SPESIFIK ROLE = DOSEN, MUNCULKAN PESAN BAGI DOSEN TERKAIT
  //     } else {
  //         $messages = Pesan::where('penerima', $a)->get();
  //     }

  //     // pass variable users, messaged to pesan.blade
  //     if($check) {
  //         return view('pesan',compact('users','messages')); //ngirim var user
  //     }
  //     else {
  //         return view('login');
  //     }
  // }

  //METHOD STORE PESAN KE DATABASE
  public function create(Request $request) {
    //VALIDASI INPUT
    $this->validate($request, [
        'subjek' => 'required',
        'penerima' => 'required',
        'pesan' => 'required'
    ]);
    
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
    return redirect('pesan');
  }

  public function detailPesan($id){
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    $message = Pesan::find($id);
    return view('detailPesan',compact('message'));
  }

  // //JOIN TABLE PESAN DENGAN USERS SEHINGGA NANTINYA DIVISI RISET BISA LANGSUNG MENGETAHUI PESAN DIKIRIM KEPADA SIAPA
  // public function joinTable(){
  //     $joinPesanUsers = DB::table('users')
  //         ->join('pesan_user', 'users.id', '=', 'pesan_user.penerima')
  //         ->select('*')
  //         ->get();

  //     return $joinPesanUsers;
  // }
}
