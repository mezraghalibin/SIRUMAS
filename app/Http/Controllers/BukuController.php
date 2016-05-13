<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Session;
use Validator;
use File;
use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\SSOController;
use App\Buku;
use App\users;
use DB;

class BukuController extends Controller
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
          if($route == '/buatbuku') {
            return view('buatbuku');
          }
          else if ($route == '/kelolabuku') {
            $dataBuku = $this->read(); //GET ALL DATA HIBAH
            return view('kelolabuku', compact('dataBuku'));
          }
           else if ($route == '/buku') {
            $dataBuku = $this->read(); //GET ALL DATA HIBAH
            return view('buku', compact('dataBuku'));
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
            
            return view('kelolabuku');
        }
        else {
            return view('login');
        }
    }
      public function read() {
        $dataBuku = Buku::all();
        return $dataBuku;
    }



    public function store(Request $request) {
        $createValidator = Validator::make($request->all(), [
          'judul' => 'required',
          'penulis' => 'required',
          'penerbit' => 'required',
          'isbn' => 'required',
          'tahun' => 'required',
          'file' => 'required',
          'jumlah_hlm' => 'required',
          'kota_terbit' => 'required'
        ]);

        //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
        if ($createValidator->fails()) {
          //FLASH MESSAGE IF FAILS
          Session::flash('flash_message','Harap Mengisi Semua Data.'); 
          return redirect('buatbuku'); //REDIRECT BACK TO BUAT BUKU PAGE
        }
        

        //BIKIN BUKU BARU
         $buku = Buku::create($request->all());

            $filename = $request->file('file')->getClientOriginalName(); 
            $request->file('file')->move(base_path().'/public/upload/buku', $filename);
            //UBAH FILENAME DI DATABASE
            $buku->file = $filename;
            $buku->save();

            Session::flash('flash_message','Buku Berhasil Dibuat'); //FLASH
            return redirect('buatbuku');     
    }


    public function edit($id)
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        
        if ($check) {
          $buku = Buku::find($id); //FIND SPECIFIC MOU
          return view('editbuku', compact('buku'));
        }
        else {
          return view('login');
        }
    }

    public function update(Request $request, $id)
    {
        $createValidator = Validator::make($request->all(), [
          'judul' => 'required',
          'penulis' => 'required',
          'penerbit' => 'required',
          'isbn' => 'required',
          'tahun' => 'required',
          //'file' => 'required',
          'jumlah_hlm' => 'required',
          'kota_terbit' => 'required'
        ]);


        //CHECK VALIDATOR, IF FAILS RETURN TO BUAT KONTAK PAGE
        if ($createValidator->fails()) {
          //FLASH MESSAGE IF FAILS
          Session::flash('flash_message','Gagal Mengubah Buku, Harap Mengisi Semua Data.'); 
          return redirect('kelolabuku'); //REDIRECT BACK TO EDIT PRESENTASI PAGE
        }

        $checkFile = Validator::make($request->all(), [
            'file' => 'required'
        ]);


        //IF FILE BARU IS NULL
        
        $bukuNew = $request; //GET JADWAL NEW BY REQUEST USER
        $bukuOld = Buku::find($id); //GET JADWAL OLD BY FIND ON TABLE JADWAL_PRESETASI

        //REPLACE THE OLD WITH THE NEW ONES
        $bukuOld->judul = $bukuNew->judul;
        $bukuOld->penulis = $bukuNew->penulis;
        $bukuOld->penerbit = $bukuNew->penerbit;
        $bukuOld->isbn = $bukuNew->isbn;
        $bukuOld->tahun = $bukuNew->tahun;    
        $bukuOld->jumlah_hlm = $bukuNew->jumlah_hlm;  
        $bukuOld->kota_terbit = $bukuNew->kota_terbit;      

        if ($checkFile->fails()) {
            //DO NOTHING
        }
        else{
        $filenameOld = public_path('upload/buku/' . $bukuOld->file);
        if(File::exists($filenameOld)) {
                File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
            }

            //STORE NEW FILE TO FOLDER MOU
            $bukuNewName = $request->file('file')->getClientOriginalName(); //SIMPAN NAMA FILE
            $bukuNew->file('file')->move(base_path().'/public/upload/buku', $bukuNewName); //SIMPAN MOU KE SUATU FOLDER

            //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
            $bukuOld->file  = $bukuNewName; //KEEP OLD FILE   
        }
            //SIMPAN SEMUA MASUKAN DALAM BENTUK KONTAK
            $bukuOld->save();
            Session::flash('flash_message','Buku Berhasil Diperbarui'); //FLASH
            return redirect('kelolabuku');
    }

public function delete($id)
    {
        $buku = Buku::find($id); //FIND SPECIFIC PRESENTASI
        Session::flash('flash_message','Buku ' . $buku->judul . ' Telah Dihapus');
        $buku->delete(); //DELETE FROM DATABASE 
        return redirect('/kelolabuku'); //REDIRECT BACK TO MOU PAGE
    }



}
