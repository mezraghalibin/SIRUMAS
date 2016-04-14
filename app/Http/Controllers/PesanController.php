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
        $a = $SSOController->getId();
        $stafRiset = \App\users::where('spesifik_role','divisi riset')->get();
        $b = $SSOController->getSpesifikRole();
        if($b == 'divisi riset'){
            $messages = \App\Pesan::where('id_pengirim', $a)->get();
        } else {
            $messages = \App\Pesan::where('penerima', $a)->get();
        }
        if($check) {
            return view('pesan',compact('users','messages','a')); //ngirim var user
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
        $msg = \App\Pesan::create($request->all());
        //untuk upload file
        $filename = $msg->id.'.'. $request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(base_path().'/public/upload/', $filename);
        $msg->file = $filename;
        $msg->save();
        Session::flash('flash_message','Pesan berhasil terkirim');
        return redirect('pesan');
    }

    public function detailPesan($id){
        $message = \App\Pesan::find($id);
        return view('detailPesan',compact('message'));
    }

}
