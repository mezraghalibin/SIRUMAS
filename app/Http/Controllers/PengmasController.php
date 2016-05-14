<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;

use Validator;

use App\Http\Controllers\Controller;

use App\Http\Controllers\SSOController;

use App\users;

use App\Pengmas;

use App\PengmasAnggota;

class PengmasController extends Controller
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
            return view('pengmas');
        }
        else {
            return view('login');
        }
    }

    public function kelola()
    {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $listofpengmas = Pengmas::paginate(10);
            return view('kelolapengmas', ['listofpengmas' => $listofpengmas]);
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
            return view('buatpengmas');
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
            'nama_kegiatan' => 'required',
            'ketua' => 'required',
            'peranan' => 'required',
            'penyelenggara' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'besar_dana' => 'required'
        ]);

        //VALIDATOR JIKA INPUT TIDAK DIISI (KECUALI FILE)
        if ($storeValidator->fails()) {
            Session::flash('flash_message', 'Harap mengisi seluruh data'); //FLASH MESSAGE IF FAILS
            return redirect('buatpengmas'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
        }

        //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
        $checkFile = Validator::make($request->all(), [
            'bukti' => 'required'
        ]);

        //Bikin pengmas
        $pengmas = Pengmas::create($request->all());

        if($checkFile->fails()){
            $pengmas->bukti = "";
        } else {
            //SIMPAN NAMA FILE
            $filename = $request->file('bukti')->getClientOriginalName(); 
            //memindahkan file yg dilampirkan tadi ke path /public/upload
            $request->file('bukti')->move(base_path().'/public/upload/pengmas', $filename);
            //UBAH FILENAME DI DATABASE
            $pengmas->bukti = $filename;
        }

        //ISI anggota
        $list = explode(";", $request->nama_anggota);
        $count = count($list);
        for($i = 0; $i < $count; $i++) {
                $nama_anggota = new PengmasAnggota;
                $nama_anggota->id_pengmas = $pengmas->id;
                $nama_anggota->nama_anggota = $list[$i];
                $nama_anggota->save();
        }

        //SAVE FILEnya
        $pengmas->save();
        // Session untuk Success Notif
        Session::flash('flash_message','Sukses membuat Pengabdian Masyarakat');
        // then rederict back to hibah
        return redirect('kelolapengmas');
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
         $pengmas = Pengmas::find($id);
         $listofanggota = PengmasAnggota::where('id_pengmas', $id)->get();
         if(!$pengmas){ 
         abort(404);
         } else {
        return view('editpengmas', ['pengmas' => $pengmas], ['listofanggota' => $listofanggota]);
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
            'nama_kegiatan' => 'required',
            'ketua' => 'required',
            'peranan' => 'required',
            'penyelenggara' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'besar_dana' => 'required'
        ]);

        //VALIDATOR JIKA INPUT TIDAK DIISI (KECUALI FILE)
        if ($storeValidator->fails()) {
            Session::flash('flash_message', 'Harap mengisi seluruh data'); //FLASH MESSAGE IF FAILS
            return redirect('buatpengmas'); //REDIRECT BACK TO BUATKEGIATANILMIAH PAGE
        }

        //CHECK FILE YANG DIUPLOAD KOSONG ATAU ENGGA
        $checkFile = Validator::make($request->all(), [
            'bukti' => 'required'
        ]);

        $pengmas = Pengmas::find($id);

         //CHANGE OLD TO NEW
        $pengmas->nama_kegiatan = $request->nama_kegiatan;
        $pengmas->ketua = $request->ketua;
        $pengmas->peranan = $request->peranan;
        $pengmas->penyelenggara = $request->penyelenggara;
        $pengmas->tempat = $request->tempat;
        $pengmas->waktu = $request->waktu;
        $pengmas->besar_dana = $request->besar_dana;

        if($checkFile->fails()){
            $pengmas->bukti = "";
        } else {
             //IF OLD FILE IS NULL OR EMPTY
            $filenameOld = public_path('upload/pengmas/' . $pengmas->bukti); //GET SPECIFIC MOU FILE NAME OLD
            if(File::exists($filenameOld)) {
                File::delete($filenameOld); //DELETE FILE FROM FOLDER MOU
            }

            //STORE NEW FILE TO FOLDER MOU
            $pengmasNewName = $request->file('bukti')->getClientOriginalName(); //SIMPAN NAMA FILE
            $pengmasNew->file('bukti')->move(base_path().'/public/upload/pengmas', $pengmasNewName); //SIMPAN MOU KE SUATU FOLDER

            //CHANGE OLD FILE NAME WITH THE NEW ONES IN DATABASE
            $pengmas->bukti  = $pengmasNewName; //KEEP OLD FILE 
        }

        //UBAH anggota
        $list = explode(";", $request->nama_anggota);
        $countNew = count($list);

        //Yang lama
        $anggotaOld = PengmasAnggota::where('id_pengmas', $id)->get();
        $countOld = count($anggotaOld);

        $check = 0;
        if($countOld == $countNew) {
            $i = 0;
            foreach ($anggotaOld as $anggota) {
                if($anggota->nama_anggota == $list[$i]) {
                    //DO NOTHING
                } else {
                    $check = 0;
                    break;
                }
                $i--;
            }
        }

        if ($check == 1) {
            //Delete old anggota
            foreach ($anggotaOld as $anggota) {
                $anggota->delete();
            }
        }

        for($i = 0; $i < $countNew; $i++) {
                $nama_anggota = new PengmasAnggota;
                $nama_anggota->id_pengmas = $pengmas->id;
                $nama_anggota->nama_anggota = $list[$i];
                $nama_anggota->save();
        }

        //SAVE FILEnya
        $pengmas->save();
        // Session untuk Success Notif
        Session::flash('flash_message','Sukses membuat Pengabdian Masyarakat');
        // then rederict back to hibah
        return redirect('kelolapengmas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengmas = Pengmas::find($id);
        $pengmas->delete();
        Session::flash('flash_message','Pengabdian Masyarakat berhasil dihapus.');
        return redirect('kelolapengmas');
    }
}
