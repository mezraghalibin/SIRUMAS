<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;

use Validator;

use App\Http\Controllers\Controller;

use App\Http\Controllers\SSOController;

use App\users;

use App\KegiatanIlmiah;

class KegiatanIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('kegiatanilmiah');
        }
        else {
            return view('login');
        }
    }

    public function kelola() {
         //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $kegiatanilmiahs= KegiatanIlmiah::paginate(10);
            return view('kelolakegiatanilmiah', ['kegiatanilmiahs' => $kegiatanilmiahs]);
        }
        else {
            return view('login');
        }
    }

    public function buat() {
         //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('buatKegiatanIlmiah');
        }
        else {
            return view('login');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //VALIDASI INPUT
        $storeValidator = Validator::make($request->all(), [
             'nama' => 'required',
            'jenis' => 'required',
            'skala' => 'required',
            'pembicara' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'sumber_dana' => 'required'
        ]);

        //VALIDATOR JIKA INPUT TIDAK DIISI (KECUALI FILE)
        if ($storeValidator->fails()) {
            Session::flash('flash_message', 'Harap mengisi seluruh data'); //FLASH MESSAGE IF FAILS
            return redirect('buatkegiatanilmiah'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
        }

        //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
        $checkFile = Validator::make($request->all(), [
            'bukti' => 'required'
        ]);

        //Bikin kegiatan ilmiah
        $kegiatan_ilmiah = KegiatanIlmiah::create($request->all());

        if($checkFile->fails()){
            $kegiatan_ilmiah->bukti = "";
        } else {
            //SIMPAN NAMA FILE
            $filename = $request->file('bukti')->getClientOriginalName(); 
            //memindahkan file yg dilampirkan tadi ke path /public/upload
            $request->file('bukti')->move(base_path().'/public/upload/kegiatanIlmiah', $filename);
            //UBAH FILENAME DI DATABASE
            $kegiatan_ilmiah->bukti = $filename;
        }

        //SAVE FILEnya
        $kegiatan_ilmiah->save();
        // Session untuk Success Notif
        Session::flash('flash_message','Sukses membuat Kegiatan Ilmiah');
        // then rederict back to hibah
        return redirect('kelolakegiatanilmiah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
         if($check) {
         $kegiatanilmiah= KegiatanIlmiah::find($id);
         if(!$kegiatanilmiah){ 
         abort(404);
         } else {
         return view('editkegiatanilmiah')->with('kegiatanilmiah',$kegiatanilmiah);
            }

        } else {
            return view('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //VALIDASI INPUT
        $storeValidator = Validator::make($request->all(), [
             'nama' => 'required',
            'jenis' => 'required',
            'skala' => 'required',
            'pembicara' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'sumber_dana' => 'required'
        ]);

        //VALIDATOR JIKA INPUT TIDAK DIISI (KECUALI FILE)
        if ($storeValidator->fails()) {
            Session::flash('flash_message', 'Harap mengisi seluruh data'); //FLASH MESSAGE IF FAILS
            return redirect('buatkegiatanilmiah'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
        }

        //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
        $checkFile = Validator::make($request->all(), [
            'bukti' => 'required'
        ]);


        $kegiatanilmiah= KegiatanIlmiah::find($id);

        //CHANGE OLD TO NEW
        $kegiatanilmiah->nama = $request->nama;
        $kegiatanilmiah->jenis = $request->jenis;
        $kegiatanilmiah->judul = $request->judul;
        $kegiatanilmiah->skala = $request->skala;
        $kegiatanilmiah->pembicara = $request->pembicara;
        $kegiatanilmiah->waktu = $request->waktu;
        $kegiatanilmiah->tempat = $request->tempat;
        $kegiatanilmiah->sumber_dana = $request->sumber_dana;

        if ($checkFile->fails()) {
            //DO NOTHING
        } else {
            //IF OLD FILE IS NULL OR EMPTY
            $filenameOld = public_path('upload/kegiatanIlmiah/' . $kegiatanilmiah->bukti); //GET SPECIFIC MOU FILE NAME OLD
            if(File::exists($filenameOld)) {
                File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
            }

            //STORE NEW FILE TO FOLDER MOU
            $ilmiahNewName = $request->file('bukti')->getClientOriginalName(); //SIMPAN NAMA FILE
            $ilmiahNew->file('bukti')->move(base_path().'/public/upload/kegiatanIlmiah', $ilmiahNewName); //SIMPAN MOU KE SUATU FOLDER

            //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
            $kegiatanilmiah->bukti  = $ilmiahNewName; //KEEP OLD FILE       
        }

        $kegiatanilmiah->save(); // save the array of models at once
        Session::flash('flash_message','Kegiatan Ilmiah berhasil diubah.');
        return redirect('kelolakegiatanilmiah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatanilmiah = KegiatanIlmiah::find($id);
        $kegiatanilmiah->delete();
        Session::flash('flash_message','Kegiatan Ilmiah berhasil dihapus.');
        return redirect('kelolakegiatanilmiah');
    }
}
