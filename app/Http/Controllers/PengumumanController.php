<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\SSOController;
use App\Pengumuman;
use App\users;

class PengumumanController extends Controller {
    public function index() {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        $a = $SSOController->getId(); // ngambil id dari sso, liat methodnya di pesan model
        $users = new users;
        $users = users::where('spesifik_role','divisi riset')->get(); //dapetin semua user yg spesifik role nya divisi riset
        $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

        // GET ALL PENGUMUMAN BASED ON ALL STAF DIVISI RISET 
        if($check) {
            if($route == '/pengumuman/buatpengumuman') {
                return view('/pengumuman/buatpengumuman', compact('users'));
            }
            else {
                $allPengumuman = $this->read();
                return view('/pengumuman/kelolapengumuman', compact('users', 'allPengumuman'));
            }
        }
        else {
            return view('login');
        }
    }

    public function edit($id){
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {  
            $pengumuman = Pengumuman::find($id);
            if(!$pengumuman){
                abort(404);
            } else {
                return view('/pengumuman/editpengumuman',compact('pengumuman'));    
            }
        }
        else {
            return view('login');
        }
    }

    public function read() {
        $dataPengumuman = Pengumuman::paginate(15); //GET ALL DATA MOU
        return $dataPengumuman;
    }

    //METHOD STORE PENGUMUMAN KE DATABASE
    public function create(Request $request){
        //VALIDATOR FOR REQUEST STORE
        $storeValidator = Validator::make($request->all(), [
            'judul' => 'required|max:50',
            'nomor' => 'max:50',
            'kategori' => 'required',
            'konten' => 'required',
            'staf_riset' => 'required'
        ]);

        //VALIDATOR JIKA JUDUL MOU DAN/ATAU BEBERAPA INPUT TIDAK DIISI (KECUALI FILE)
        if ($storeValidator->fails()) {
            Session::flash('flash_message', 'Harap Mengisi Seluruh Data'); //FLASH MESSAGE IF FAILS
            return redirect()->back(); //REDIRECT BACK TO KELOLAMOU PAGE
        }

        //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
        $checkFile = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        //BIKIN PENGUMUMAN BARU
        $pengumuman = Pengumuman::create($request->all());
        if($checkFile->fails()){
            $pengumuman->file = "";
        } else {
            //SIMPAN NAMA FILE
            $filename = $request->file('file')->getClientOriginalName(); 
            //memindahkan file yg dilampirkan tadi ke path /public/upload
            $request->file('file')->move(base_path().'/public/upload/pengumuman', $filename);
            //UBAH FILENAME DI DATABASE
            $pengumuman->file = $filename;
        }

        //SAVE TO DATABASE
        $pengumuman->save();
        // SUCCESS MESSAGE
        Session::flash('flash_message','Pengumuman berhasil dibuat');
        // then rederict back to pesan
        return redirect('/pengumuman/kelolapengumuman');
    }

    public function update(Request $request, $id){
        //VALIDATOR FOR REQUEST UPDATE
        $updateValidator = Validator::make($request->all(), [
            'judul' => 'required|max:50',
            'nomor' => 'max:50',
            'kategori' => 'required',
            'konten' => 'required'
        ]);

        //VALIDATOR JIKA JUDUL MOU DAN/ATAU BEBERAPA INPUT TIDAK DIISI (KECUALI FILE)
        if ($updateValidator->fails()) {
            Session::flash('flash_message', 'Harap Mengisi Seluruh Data'); //nampilin kalo sukses
            return redirect()->back(); //REDIRECT BACK TO KELOLAMOU PAGE
        }

        //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
        $checkFile = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        //UPDATE PENGUMUMAN BARU
        $pengumumanNew = $request;
        $pengumumanOld = Pengumuman::find($id);

        //CHANGES THE OLD TO THE NEW ONES
        $pengumumanOld->judul    = $pengumumanNew->judul;
        $pengumumanOld->nomor    = $pengumumanNew->nomor;
        $pengumumanOld->status   = $pengumumanNew->status;
        $pengumumanOld->kategori = $pengumumanNew->kategori;
        $pengumumanOld->konten   = $pengumumanNew->konten;
        
        //IF FILE BARU IS NULL
        if ($checkFile->fails()) {
            //DO NOTHING
        }
        else {
            //IF OLD FILE IS NULL OR EMPTY
            $filenameOld = public_path('upload/pengumuman/' . $pengumumanOld->file); //GET SPECIFIC MOU FILE NAME OLD
            if(File::exists($filenameOld)) {
                File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
            }

            //STORE NEW FILE TO FOLDER MOU
            $pengumumanNewName = $request->file('file')->getClientOriginalName(); //SIMPAN NAMA FILE
            $pengumumanNew->file('file')->move(base_path().'/public/upload/pengumuman', $pengumumanNewName); //SIMPAN MOU KE SUATU FOLDER

            //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
            $pengumumanOld->file  = $pengumumanNewName; //KEEP OLD FILE    
        }

        //SAVE FILE TO DATABASE
        $pengumumanOld->save();
        // FLASH MESSAGE UNTUK SUKSES
        Session::flash('flash_message','Pengumuman Berhasil Diperbarui');
        // then rederict back to pesan
        return redirect('/pengumuman/kelolapengumuman');
    }
    
    public function delete($id) {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();
        Session::flash('flash_message', 'Pengumuman berhasil dihapus!');
        return redirect('/pengumuman/kelolapengumuman');
    }

    public function publikasi($id){
        $pengumuman = Pengumuman::find($id);
        $pengumuman->status = 1;
        $pengumuman->save();
        Session::flash('flash_message', 'Pengumuman berhasil dipublish!');
        return redirect('/pengumuman/kelolapengumuman');
    }
}
