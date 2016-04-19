<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\users;
use App\proposal;
use App\Hibah;
use DB;

class ProposalHibahController extends Controller {
    public function index() {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        $users = users::all();
        $id = $SSOController->getId();
        $spesifik_role = $SSOController->getSpesifikRole();

        if($check) {
             $dataHibah = $this->readHibah();

            // $dataProposal = $this->joinTabel(); 
            return view('proposalhibah', compact('dataHibah'));
        }
        else {
            return view('login');
        }
    }

    public function nilaiProposal() {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('nilaiproposal');
        }
        else {
            return view('login');
        }
    }

    public function sesuaikanProposal() {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('sesuaikanproposal');
        }
        else {
            return view('login');
        }
    }

     public function readHibah() {
        $dataHibah = Hibah::all();
        return $dataHibah;
    }
    
    public function getProposalRiset($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $hibah = Hibah::find($id);

            $AllProposal = DB::table('proposal')
                ->join('hibah', 'id_hibah', '=', 'hibah.id')
                ->select('*')
                ->where('proposal.id_hibah', '=', $hibah->id)
                ->get();

            //$AllProposal = Proposal::find($id);

            return view('daftarproposalhibahriset', compact('AllProposal'));
        }
        else {
            return view('login');
        }
    }

    public function getProposalPengmas($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $hibah = Hibah::find($id);

            $AllProposal = DB::table('proposal')
                ->join('hibah', 'id_hibah', '=', 'hibah.id')
                ->select('*')
                ->where('proposal.id_hibah', '=', $hibah->id)
                ->get();

            //$AllProposal = Proposal::find($id);

            return view('daftarproposalhibahpengmas', compact('AllProposal'));
        }
        else {
            return view('login');
        }
    }



}
    // public function joinTabel() {
 
    //        $joinProposalHibah =  DB::table('proposal')
    //         ->join('hibah', 'id_hibah', '=', 'hibah.id')
    //         ->select('*')
    //         ->where('proposal.id_hibah', '=', '')
    //         ->get();
    //         return $joinProposalHibah;
    // }



