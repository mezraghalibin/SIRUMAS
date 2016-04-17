<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\users;
use Session;

class HibahController extends Controller
{
    public function index()
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
        $users = users::where('spesifik_role','dosen')->get(); //dapetin semua user yg spesifik role nya dosen
        $id = $SSOController->getId(); // ngambil id dari sso 
        $spesifik_role = $SSOController->getSpesifikRole(); // ambil spesifik role dr users


        if($check) {
            return view('hibah');
        }
        else {
            return view('login');
        }
    }

    public function applyHibah()
    {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('applyHibah');
        }
        else {
            return view('login');
        }
    }


//METHOD STORE PROPOSAL KE DATABASE
    public function storeProposal(Request $request){
        //VALIDASI INPUT
        $this->validate($request, [
            'nama_pengaju' => 'required',
            'nip/nup' => 'required',
            'e-mail' => 'required',
            'no_hp' => 'required',
            'judul_proposal' => 'required',
            'file' => 'required'
            ]);

        //Bikin proposal
        $aProposal = \App\Proposal::create($request->all());
        //untuk upload file, request file dengan segala extensi
        $filename = $aProposal->id.'.'. $request->file('file')->getClientOriginalExtension();
        //memindahkan file yg dilampirkan tadi ke path /public/upload
        $request->file('file')->move(base_path().'/public/upload/', $filename);
        $aProposal->file = $filename;
        //SAVE FILEnya
        $aProposal->save();
        // Session untuk Success Notif
        Session::flash('flash_message','Sukses meng-apply hibah');
        // then rederict back to pesan
        return redirect('applyhibah');
    }

    public function kelolaHibah()
    {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('kelolaHibah');
        }
        else {
            return view('login');
        }
    }
}
