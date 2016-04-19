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
             $proposalnya = $this->getPenyesuaianKeuangan();
             $penyesuaianKeuangan = DB::select(
                        "SELECT 
                        menyesuaikan_keuangan.komentar, 
                        proposal.*
                        FROM menyesuaikan_keuangan, proposal
                        WHERE proposal.id IN  
                            (SELECT menyesuaikan_keuangan.id_proposal
                            FROM menyesuaikan_keuangan)"
                    
                );
             //return($penyesuaianKeuangan);
            // $dataProposal = $this->joinTabel(); 
            return view('proposalhibah', compact('dataHibah','penyesuaianKeuangan'));
        }
        else {
            return view('login');
        }
    }

    public function nilaiProposalRiset($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $proposal= Proposal::find($id);
            $borangs = DB::table('borang')->get();
            return view('nilaiproposalriset', ['borangs' => $borangs], ['proposal' => $proposal]);
        }
        else {
            return view('login');
        }
    }

    public function nilaiProposalPengmas($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $proposal= Proposal::find($id);
            $borangs = DB::table('borang')->get();
            //$pdf = DB::table('proposal')->select('file')->where('id_proposal', $id)->get();
            return view('nilaiproposalpengmas', ['borangs' => $borangs], ['proposal' => $proposal]);
        }
        else {
            return view('login');
        }
    }

    public function sesuaikanProposalRiset($id) {
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $proposal= Proposal::find($id);
            return view('sesuaikanproposalriset', ['proposal' => $proposal]);
        }
        else {
            return view('login');
        }
    }

     public function sesuaikanProposalPengmas($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            $proposal= Proposal::find($id);
            return view('sesuaikanproposalpengmas', ['proposal' => $proposal]);
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
            $penyesuaianKeuangan = DB::select(
                        "SELECT 
                        menyesuaikan_keuangan.komentar, 
                        proposal.*
                        FROM menyesuaikan_keuangan, proposal
                        WHERE proposal.id IN  
                            (SELECT menyesuaikan_keuangan.id_proposal
                            FROM menyesuaikan_keuangan)"
                    
                );
            $AllProposal = DB::table('proposal')
                ->join('hibah', 'id_hibah', '=', 'hibah.id')
                ->select('*')
                ->where('proposal.id_hibah', '=', $hibah->id)
                ->get();


            //$AllProposal = Proposal::find($id);

            return view('daftarproposalhibahriset', compact('AllProposal','penyesuaianKeuangan'));
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

    public function getPenyesuaianKeuangan() {        
        $penyesuaianKeuangan = DB::select(
                        "SELECT 
                        menyesuaikan_keuangan.komentar, 
                        proposal.id
                        FROM menyesuaikan_keuangan, proposal
                        WHERE proposal.id IN  
                            (SELECT menyesuaikan_keuangan.id_proposal
                            FROM menyesuaikan_keuangan)"
                    
                );
    }
}