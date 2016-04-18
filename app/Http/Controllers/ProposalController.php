<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\users;
use App\proposal;
use DB;
use Session;
use Validator;

class ProposalController extends Controller {
    public function index() {
    	//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        //$getId = $SSOController->getId();

        $users = users::where('spesifik_role','dosen')->get(); //dapetin semua user yg spesifik role nya dosen
        $id = $SSOController->getId(); // ngambil id dari sso 
        $spesifik_role = $SSOController->getSpesifikRole(); // ambil spesifik role dr users


       // pass variable users, messaged to pesan.blade
        if($check) {
            $dataProposal = $this->joinTabel($_SESSION['id']); //GET ALL HIBAH
            return view('proposal', compact('dataProposal'));
        }
        else {
            return view('login');
        }
    }

    public function uploadRevisi($id_proposal) {
    	//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();

        if($check) {
            $dataProposal = $this->joinTabelRevisi($_SESSION['id'], $id_proposal); //GET ALL HIBAH
            return view('proposalupload', compact('dataProposal'));
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
        $filenameNew = $proposalOld->id . "_" . $proposalOld->nama_pengaju. '_' . $proposalOld->judul_proposal . '_Revisi.'. 
            $request->file('file')->getClientOriginalExtension(); //RENAME NEW FILE
        $request->file('file')->move(public_path() .'upload/proposal', $filenameNew); //MASUKIN FILE BARU KE FOLDER
        
        //PLAY WITH OLD FILE
        $filenameOld = public_path('upload/proposal/' . $proposalOld->file); //GET SPECIFIC MOU FILE NAME
        if (File::exists($filenameOld)) {
            File::delete($filenameOld); //DELETE FILE FROM DIRECTORY
        }

        $proposalOld->file = $filename;// SAVE THE NEW ONES
        $proposalOld->save(); //SAVE TO DATABASE
        Session::flash('flash_message','Revisi Proposal Berhasil Dilakukan'); //FLASH MESSAGE
        return redirect('proposal');
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