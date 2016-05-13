<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\users;
use App\Proposal;
use DB;
use Session;
use Validator;
use File;

class ProposalController extends Controller {
  public function index() {
  	//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    //$getId = $SSOController->getId();

    $users = users::where('spesifik_role','dosen')->get(); //dapetin semua user yg spesifik role nya dosen
    $id = $SSOController->getId(); // ngambil id dari sso 
    $spesifik_role = $SSOController->getSpesifikRole(); // ambil spesifik role dr users

    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      if($route == '/proposal/daftarProposal') {
        $dataProposal = $this->joinTabel($_SESSION['id']); //GET ALL HIBAH
        return view('/proposal/daftarProposal', compact('dataProposal'));
      }
      else if($route == '/proposal/uploadRevisiProposal') {
        $dataProposal = $this->joinTabel($_SESSION['id']); //GET ALL HIBAH
        return view('/proposal/uploadRevisiProposal', compact('dataProposal'));
      }
      else {
        $dataProposal = $this->joinTabel($_SESSION['id']); //GET ALL HIBAH
        return view('/proposal/daftarProposal', compact('dataProposal'));
      }
    }
    else {
      return view('login');
    }
  }

  public function revisiProposal($id_proposal) {
	//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

    if($check) {
      $dataProposal = $this->joinTabelRevisi($_SESSION['id'], $id_proposal); //GET ALL HIBAH
      return view('/proposal/revisiProposal', compact('dataProposal'));
    }
    else {
      return view('login');
    }
  }

  public function revisi(Request $request, $id) {
    $this->validate($request, [
      'file' => 'required'
    ]);

    $proposalOld = Proposal::find($id); //GET HIBAH OLD BY FIND ON TABLE HIBAH

    //PLAY WITH NEW FILE
    $filenameNew = $request->file('file')->getClientOriginalName(); //RENAME NEW FILE
    $request->file('file')->move(public_path('/upload/proposal'), $filenameNew); //MASUKIN FILE BARU KE FOLDER
    
    //PLAY WITH OLD FILE
    $filenameOld = public_path('upload/proposal/' . $proposalOld->file); //GET SPECIFIC MOU FILE NAME
    if (File::exists($filenameOld)) {
      File::delete($filenameOld); //DELETE FILE FROM DIRECTORY
    }

    $proposalOld->file = $filenameNew;// SAVE THE NEW ONES
    $proposalOld->save(); //SAVE TO DATABASE
    Session::flash('flash_message','Revisi Proposal Berhasil Dilakukan'); //FLASH MESSAGE
    return redirect('/proposal/daftarProposal');
  }

  //METHOD STORE PROPOSAL KE DATABASE
  public function create(Request $request) {
    //VALIDASI INPUT
    $this->validate($request, [
      'status' => 'required',
      'id_hibah' => 'required'
    ]);

    //Bikin proposal
    $proposal = Proposal::create($request->all());
    //untuk upload file, request file dengan segala extensi
    $filename = $request->file('file')->getClientOriginalName();
    //memindahkan file yg dilampirkan tadi ke path /public/upload
    $request->file('file')->move(base_path().'/public/upload/proposal', $filename);
    $proposal->file = $filename;
    //SAVE FILEnya
    $proposal->save();
    // Session untuk Success Notif
    Session::flash('flash_message','Sukses meng-apply hibah');
    // then rederict back to hibah
    return redirect('/proposal/daftarProposal');
  }

  public function read($id) {
      $dataProposal = Proposal::where('dosen', $id)->get();
      return $dataProposal;
  }

  //JOIN TABLE PROPOSAL DAN TABLE HIBAH DIMANA ID HIBAH PADA PROPOSAL = ID HIBAH PADA HIBAH
  public function joinTabel($id_user) {
      $joinProposalHibah =  DB::table('hibah')
          ->join('proposal', 'hibah.id', '=', 'proposal.id_hibah')
          ->select('*')
          ->where('proposal.dosen', '=', $id_user)
          ->get();
          return $joinProposalHibah;
  }

  //JOIN TABLE PROPOSAL DAN TABLE HIBAH DIMANA ID HIBAH PADA PROPOSAL = ID HIBAH PADA HIBAH
  //DAN ID PROPOSAL = YANG DITUJU
  public function joinTabelRevisi($id_user, $id_proposal) {
      $joinProposalHibah = DB::table('hibah')
          ->join('proposal', 'hibah.id', '=', 'proposal.id_hibah')
          ->select('*')
          ->where('proposal.dosen', '=', $id_user)
          ->where('proposal.id', '=', $id_proposal)
          ->get();
          return $joinProposalHibah;
  }
}