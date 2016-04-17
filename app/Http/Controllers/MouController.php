<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;
use App\MoU;

class MouController extends Controller
{
    //
	public function index()
	{
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('mou');
        }
        else {
            return view('login');
        }
	}

    public function upload(Request $request) {
        $this->validate($request, [
            'file' => 'required',
            'peneliti' => 'required',
            'judul' => 'required'
        ]);

        //INPUT NEW FILE
        $mou = MoU::create($request->all()); //SIMPAN SEMUA MASUKAN KE DATABASE
        $mouname = $mou->peneliti . '-' . $mou->judul . "." . $request->file('file')->getClientOriginalExtension(); //SIMPAN NAMA FILE
        $request->file('file')->move(base_path().'/public/upload/MoU', $mouname); //SIMPAN MOU KE SUATU FOLDER
        $mou->file = $mouname; //MENAMAKAN FILE MOU DIDALAM DATABASE
        $mou->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
        Session::flash('flash_message','MoU Telah Tersimpan'); //nampilin kalo sukses
        return redirect('mou');

    }
}
