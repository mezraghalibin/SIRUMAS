<?php

namespace App\Http\Controllers;

use Session;
use Response;
use DB;
use Validator;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\MoU;

class MouController extends Controller {
	public function index() {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

        if($check) {
            $dataMoU = $this->joinTable(); //CALL FUNCTION JOIN TABLE TO VARIABLE
            return view('mou', compact('dataMoU'));
        }
        else {
            return view('login');
        }
	}

    public function kelolaMoU($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

        if($check) {
            $dataMoU = MoU::find($id); //GET SPECIFIC MOU
            return view('kelolamou', compact('dataMoU'));
        }
        else {
            return view('login');
        }
    }

    public function upload(Request $request) {
        $uploadValidator = Validator::make($request->all(), [
            'file' => 'required',
            'peneliti' => 'required',
            'judul' => 'required',
            'staf_riset' => 'required',
            'updated_by' => 'required'
        ]);

        if ($uploadValidator->fails()) {
            //FLASH MESSAGE IF FAILS
            Session::flash('flash_message', 'Harap Mengisi Seluruh Form');
            return redirect('mou');
        }

        //INPUT NEW FILE
        $mou = MoU::create($request->all()); //SIMPAN SEMUA MASUKAN KE DATABASE
        $mouname = $request->file('file')->getClientOriginalName(); //SIMPAN NAMA FILE
        $request->file('file')->move(base_path().'/public/upload/MoU', $mouname); //SIMPAN MOU KE FOLDER MOU
        $mou->file = $mouname; //MENAMAKAN FILE MOU DIDALAM DATABASE
        $mou->save(); //SAVE PERUBAHAN YANG DILAKUKAN KEDALAM DATABASE
        Session::flash('flash_message','MoU Telah Berhasil Dibuat'); //FLASH MESSAGE IF SUKSES
        return redirect('mou');
    }

    public function read() {
        $dataMoU = MoU::all(); //GET ALL DATA MOU
        return $dataMoU;
    }

    public function update(Request $request, $id)  {
        $updateValidator = Validator::make($request->all(), [
            'peneliti' => 'required',
            'judul' => 'required',
            'staf_riset' => 'required',
            'updated_by' => 'required'
        ]);

        //VALIDATOR JIKA JUDUL MOU DAN/ATAU NAMA PENELITI TIDAK DIISI
        if ($updateValidator->fails()) {
            Session::flash('flash_message', 'Harap Mengisi Judul MoU dan Nama Peneliti'); //nampilin kalo sukses
            return view('kelolamou'); //REDIRECT BACK TO KELOLAMOU PAGE
        }

        //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
        $checkFile = Validator::make($request->all(), [
            'file' => 'required',
        ]);

        $mouNew = $request; //GET HIBAH NEW BY REQUEST USER
        $mouOld = MoU::find($id); //GET HIBAH OLD BY FIND ON TABLE HIBAH

        //REPLACE THE OLD WITH THE NEW ONES
        $mouOld->peneliti   = $mouNew->peneliti;
        $mouOld->judul      = $mouNew->judul;
        $mouOld->updated_by = $mouNew->updated_by;

        //IF UPLOAD FILE KOSONG
        if ($checkFile->fails()) {
            $mouOld->file = $mouOld->file; //KEEP OLD FILE
        }

        //IF UPLOAD FILE TIDAK KOSONG
        else {
            //DELETE THE OLD FILES IN FOLDER MOU
            $filenameOld = public_path('upload/MoU/' . $mouOld->file); //GET SPECIFIC MOU FILE NAME OLD
            if(File::exists($filenameOld)) {
                File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
            }

            //STORE NEW FILE TO FOLDER MOU
            $mouNewName = $request->file('file')->getClientOriginalName(); //SIMPAN NAMA FILE
            $mouNew->file('file')->move(base_path().'/public/upload/MoU', $mouNewName); //SIMPAN MOU KE SUATU FOLDER

            //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
            $mouOld->file  = $mouNewName; //KEEP OLD FILE
        }        

        $mouOld->save(); //SAVE TO DATABASE
        Session::flash('flash_message', 'MOU Berhasil Diperbaharui'); //FLASH MESSAGE
        return redirect('mou'); //REDIRECT BACK TO MOU PAGE
    }

    public function delete($id) {
        $MoU = MoU::find($id); //FIND SPECIFIC MOU
        Session::flash('flash_message','MoU Milik ' . $MoU->peneliti . ' Berjudul ' . $MoU->judul . ' Telah Dihapus');
        
        $filename = public_path('upload/MoU/' . $MoU->file); //GET SPECIFIC MOU FILE NAME
        if(File::exists($filename)) {
            File::delete($filename); //DELETE FILE FROM DIRECTORY
            $MoU->delete(); //DELETE FROM DATABASE 
        }
        return redirect('mou'); //REDIRECT BACK TO MOU PAGE
    }

    //JOIN TABLE USERS DENGAN MOU
    public function joinTable() {
        $joinUsersMoU =  DB::table('users')
            ->join('mou_peneliti', 'users.id', '=', 'mou_peneliti.staf_riset')
            ->select('*')
            ->get();
            return $joinUsersMoU;
    }
}
