<?php

namespace App\Http\Controllers;


use Session;
use Validator;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\SSOController;
use App\Penelitian;
use App\users;
use DB;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
         $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE


        // $a = $SSOController->getId();
        // $users = new users;
        // $users = users::where('spesifik_role','divisi riset')->get(); 


       if ($check) {
          if($route == '/buatpenelitian') {
            return view('buatpenelitian');
          }
          else if ($route == '/kelolapenelitian') {
            $dataPenelitian = $this->read(); //GET ALL DATA HIBAH
            return view('kelolapenelitian', compact('dataPenelitian'));
          }
           else if ($route == '/penelitian') {
            $dataPenelitian = $this->read(); //GET ALL DATA HIBAH
            return view('penelitian', compact('dataPenelitian'));
        }
        else {
          return view('login');
        }
    }
}


    public function kelola() {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            
            return view('kelolapenelitian');
        }
        else {
            return view('login');
        }
    }

    public function store(Request $request) {
        $createValidator = Validator::make($request->all(), [
          'judul' => 'required',
          'ketua' => 'required',
          'sumber_dana' => 'required',
          'besar_dana' => 'required',
          'file' => 'required'
        ]);

        //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
        if ($createValidator->fails()) {
          //FLASH MESSAGE IF FAILS
          Session::flash('flash_message','Harap Mengisi Semua Data.'); 
          return redirect('buatpenelitian'); //REDIRECT BACK TO BUAT PENELITIAN PAGE
        }
        

        //BIKIN PENELITIAN BARU
         $penelitian = Penelitian::create($request->all());

            $filename = $request->file('file')->getClientOriginalName(); 
            $request->file('file')->move(base_path().'/public/upload/penelitian', $filename);
            //UBAH FILENAME DI DATABASE
            $penelitian->file = $filename;
            $penelitian->save();

            Session::flash('flash_message','Penelitian Berhasil Dibuat'); //FLASH
            return redirect('buatpenelitian');
        
    }

    public function edit($id)
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
        if ($check) {
          $penelitian = Penelitian::find($id); //FIND SPECIFIC MOU
          return view('editpenelitian', compact('penelitian'));
        }
        else {
          return view('login');
        }
    }

    public function update(Request $request, $id)
    {
        $createValidator = Validator::make($request->all(), [
          'judul' => 'required',
          'ketua' => 'required',
          'sumber_dana' => 'required',
          'besar_dana' => 'required'
          //'file' => 'required'
        ]);

        //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
        if ($createValidator->fails()) {
          //FLASH MESSAGE IF FAILS
          Session::flash('flash_message','Gagal Mengubah Penelitian, Harap Mengisi Semua Data.'); 
          return redirect('kelolapenelitian'); //REDIRECT BACK TO EDIT PRESENTASI PAGE
        }

        $checkFile = Validator::make($request->all(), [
            'file' => 'required'
        ]);


        //IF FILE BARU IS NULL
        
        $penelitianNew = $request; //GET JADWAL NEW BY REQUEST USER
        $penelitianOld = Penelitian::find($id); //GET JADWAL OLD BY FIND ON TABLE JADWAL_PRESETASI

        //REPLACE THE OLD WITH THE NEW ONES
        $penelitianOld->judul = $penelitianNew->judul;
        $penelitianOld->ketua = $penelitianNew->ketua;
        $penelitianOld->sumber_dana = $penelitianNew->sumber_dana;
        $penelitianOld->besar_dana = $penelitianNew->besar_dana;
        $penelitianOld->staf_riset = $penelitianNew->staf_riset;    
        
        if ($checkFile->fails()) {
            //DO NOTHING
        }
        else{
        $filenameOld = public_path('upload/penelitian/' . $penelitianOld->file);
        if(File::exists($filenameOld)) {
                File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
            }

            //STORE NEW FILE TO FOLDER MOU
            $penelitianNewName = $request->file('file')->getClientOriginalName(); //SIMPAN NAMA FILE
            $penelitianNew->file('file')->move(base_path().'/public/upload/penelitian', $penelitianNewName); //SIMPAN MOU KE SUATU FOLDER

            //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
            $penelitianOld->file  = $penelitianNewName; //KEEP OLD FILE   
        }
            //SIMPAN SEMUA MASUKAN DALAM BENTUK KONTAK
            $penelitianOld->save();
            Session::flash('flash_message','Penelitian Berhasil Diperbarui'); //FLASH
            return redirect('kelolapenelitian');
    }
    
    public function read() {
        $dataPenelitian = Penelitian::all();
        return $dataPenelitian;
    }

    public function delete($id)
    {
        $penelitian = Penelitian::find($id); //FIND SPECIFIC PRESENTASI
        Session::flash('flash_message','Penelitian ' . $penelitian->judul . ' Telah Dihapus');
        $penelitian->delete(); //DELETE FROM DATABASE 
        return redirect('/kelolapenelitian'); //REDIRECT BACK TO MOU PAGE
    }
}

