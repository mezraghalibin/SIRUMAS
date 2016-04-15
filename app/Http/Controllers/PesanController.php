<?php

namespace App\Http\Controllers;

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
        if($check) {
            return view('pesan',compact('users')); //ngirim var user
        }
        else {
            return view('login');
        }
    }

    //METHOD STORE PESAN KE DATABASE
    public function store(Request $request){
        //VALIDASI INPUT
        $this->validate($request, [
            'subjek' => 'required',
            'penerima' => 'required',
            'pesan' => 'required'
        ]);
        
        //BIKIN PESAN BARU
        $msg = \App\Pesan::create($request->all()); //udah kesimpen ke database
        $filename = $msg->id.'.'. $request->file('file')->getClientOriginalExtension(); //nyimpen nama file
        $request->file('file')->move(base_path().'/public/upload/', $filename); //nyimpen upload file di suatu folder
        $msg->file = $filename; //namain filenya buat di database sesuai nama yang dibuat sebelumnya
        $msg->save(); //save ke database
        Session::flash('flash_message','Pesan berhasil terkirim'); //nampilin kalo sukses
        return redirect('pesan');
    }


}
