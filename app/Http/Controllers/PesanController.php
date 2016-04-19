<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePesanFormRequest;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;

class PesanController extends Controller
{
    public function index()
    {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
        $users = \App\users::where('spesifik_role','dosen')->get(); //dapetin semua user yg spesifik role nya dosen
        $a = $SSOController->getId(); // ngambil id dari sso, liat methodnya di pesan model
        $b = $SSOController->getSpesifikRole(); // ambil spesifik role dr user, liat methodnya di pesan model
        // jika spesifik role nya adalah divisi riset, munculin pesan mana aja yang pernah dikirim oleh dirinya
        if($b == 'divisi riset'){
            $messages = \App\Pesan::where('id_pengirim', $a)->get();
        // jika spesifik rolenya dosen, munculin pesan yg diterima oleh dosen ybs
        } else {
            $messages = \App\Pesan::where('penerima', $a)->get();
        }
        // pass variable users, messaged to pesan.blade
        if($check) {
            return view('pesan',compact('users','messages')); //ngirim var user
        }
        else {
            return view('login');
        }
       

    }

    //METHOD STORE PESAN KE DATABASE
    public function store(CreatePesanFormRequest $request){
        //VALIDASI INPUT
        // if($this->validate($request, [
        //     'subjek' => 'required',
        //     'penerima' => 'required',
        //     'pesan' => 'required'
        //     ]);
        //BIKIN PESAN BARU
        if($request->hasFile('file')){
            $msg = \App\Pesan::create($request->all());
            //untuk upload file, request file dengan segala extensi
            $filename = $request->file('file')->getClientOriginalName();
            //memindahkan file yg dilampirkan tadi ke path /public/upload
            $request->file('file')->move(base_path().'/public/upload/', $filename);
            $msg->file = $filename;
            //SAVE FILEnya
            $msg->save();
        } else {
             $msg = \App\Pesan::create($request->all());
             $msg->file = null;
             $msg->save();
        }
        
        // Session untuk Success Notif
        Session::flash('flash_message','Pesan berhasil terkirim');
        // then rederict back to pesan
        return redirect('pesan');
    }

    public function detailPesan($id){
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
        $message = \App\Pesan::find($id);
        return view('detailPesan',compact('message'));
    }

}
