<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\users;
use App\proposal;
use DB;

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

    public function uploadRevisi() {
    	//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('proposalupload');
        }
        else {
            return view('login');
        }
    }

    // public function read($id) {
    //     $dataProposal = Proposal::where('dosen', $id)->get();
    //     return $dataProposal;
    // }

    public function joinTabel($id_user) {
        $joinProposalHibah =  DB::table('proposal')
            ->join('hibah', 'id_hibah', '=', 'hibah.id')
            ->select('*')
            ->where('proposal.dosen', '=', $id_user)
            ->get();
            return $joinProposalHibah;
    }

}
