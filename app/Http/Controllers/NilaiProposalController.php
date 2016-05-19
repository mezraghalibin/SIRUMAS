<?php

namespace App\Http\Controllers;
use App\NilaiProposal;
use App\Borang;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Penilaian;

class NilaiProposalController extends Controller
{
    public $layout = 'layout.default';
    public function index() {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $borangs = DB::table('borang')->get();
            return view('nilaiproposal', ['borangs' => $borangs]);
        }
        else {
            return view('login');
        }
    }

    public function create() {
        //
    }
    
    public function store(Request $request) {
        $this->validate($request, [
        'nama_komp' => 'required|max:255',
        'nilai' => 'required',
        'id_proposal' => 'required',
        ]);

        $komponenString = implode(",", $request->get('nama_komp'));
       
        $input=Input::all();
        $count = count($input['nama_komp']); // here we will know how many entries have been posted
        $languages = array();
        for($i=0; $i<$count; $i++){
           if(!empty($input['nama_komp'][$i])){
             array_push($languages, array( // iterate through each entry and create an array of inputs
              'nama_komp' => $input['nama_komp'][$i], 
              'nilai' => $input['nilai'][$i], 
              'id_proposal' => $input['id_proposal'][$i],
              'staf_riset' => $input['staf_riset'][$i]
             ));
           }
        }
        NilaiProposal::insert($languages); // save the array of models at once
        Session::flash('flash_message','Penilaian berhasil disimpan.');
        return redirect('nilaiproposal');
    }

    public function storeRiset(Request $request, $id) {
        $this->validate($request, [
        'nama_komp' => 'required|max:255',
        'nilai' => 'required',
        'id_proposal' => 'required',
        ]);
        
        $komponenString = implode(",", $request->get('nama_komp'));
        $input=Input::all();
        $count = count($input['nama_komp']); // here we will know how many entries have been posted
        $proposal = array();
        for($i=0; $i<$count; $i++){
           if(!empty($input['nama_komp'][$i])){
             array_push($proposal, array( // iterate through each entry and create an array of inputs
              'nama_komp' => $input['nama_komp'][$i], 
              'nilai' => $input['nilai'][$i], 
              'id_proposal' => $input['id_proposal'][$i],
              'staf_riset' => $input['staf_riset'][$i]
             ));
           }
        }
        NilaiProposal::insert($proposal); // save the array of models at once

        $Penilaian = new Penilaian();
        $id_proposal = $request->get('id_proposal'); 
        $staf_riset = $request->get('staf_riset');
        $Penilaian->id_proposal = $id_proposal[0];
        $Penilaian->staf_riset = $staf_riset[0];
        $Penilaian->nilai_proposal = $this->hitungNilai($id_proposal[0]);
        $Penilaian->save();
        Session::flash('flash_message','Penilaian berhasil disimpan.');
        return redirect('proposalriset');
    }

    public function hitungNilai($id){
        $rata_rata = 0;
        $jumlah = 0;
        $getProposal = DB::table('komponen_nilai_proposal')
            ->select('komponen_nilai_proposal.*')
            ->where('komponen_nilai_proposal.id_proposal', '=', $id)
            ->get();
        
        
        foreach($getProposal as $p){
          $jumlah += $p->nilai;
        }

        $rata_rata = $jumlah / count($getProposal);
        return $rata_rata;
    }

    public function storePengmas(Request $request, $id) {
        $this->validate($request, [
        'nama_komp' => 'required|max:255',
        'nilai' => 'required',
        'id_proposal' => 'required',
        ]);
        
        $komponenString = implode(",", $request->get('nama_komp'));
        $input=Input::all();
        $count = count($input['nama_komp']); // here we will know how many entries have been posted
        $proposal = array();
        for($i=0; $i<$count; $i++){
           if(!empty($input['nama_komp'][$i])){
             array_push($proposal, array( // iterate through each entry and create an array of inputs
              'nama_komp' => $input['nama_komp'][$i], 
              'nilai' => $input['nilai'][$i], 
              'id_proposal' => $input['id_proposal'][$i],
              'staf_riset' => $input['staf_riset'][$i]
             ));
           }
        }
        NilaiProposal::insert($proposal); // save the array of models at once

        $Penilaian = new Penilaian();
        $id_proposal = $request->get('id_proposal'); 
        $staf_riset = $request->get('staf_riset');
        $Penilaian->id_proposal = $id_proposal[0];
        $Penilaian->staf_riset = $staf_riset[0];
        $Penilaian->nilai_proposal = $this->hitungNilai($id_proposal[0]);
        $Penilaian->save();
        Session::flash('flash_message','Penilaian berhasil disimpan.');
        return redirect('proposalpengmas');
    }

    public function getBorang() {
      View::share('borangs', DB::table('borang')->get());
    }

    protected function setupLayout() {
      if (! is_null($this->layout)) {
        $this->layout = View::make($this->layout);
      }
    }
}
