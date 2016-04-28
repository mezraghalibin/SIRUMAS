<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\users;
use App\proposal;
use App\Hibah;
use App\Borang;
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
                        "SELECT menyesuaikan_keuangan.komentar, proposal.*
                        FROM menyesuaikan_keuangan, proposal
                        WHERE proposal.id IN  
                            (SELECT menyesuaikan_keuangan.id_proposal
                            FROM menyesuaikan_keuangan)"
                );
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
            $proposal = Proposal::find($id);
            $borangs = DB::table('borang')->get();
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
                        "SELECT *
                         FROM proposal
                         left join menyesuaikan_keuangan on proposal.id = menyesuaikan_keuangan.id_proposal
                         left join menilai_proposal on proposal.id = menilai_proposal.id_proposal
                         left join hibah on $id = proposal.id_hibah"
                );
            $AllProposal = DB::table('hibah')
                ->join('proposal', 'proposal.id_hibah', '=', 'hibah.id')
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
            $penyesuaianKeuangan = DB::select(
                                       "SELECT * from 
                        proposal left join menyesuaikan_keuangan on proposal.id = menyesuaikan_keuangan.id_proposal left join
                        menilai_proposal on proposal.id = menilai_proposal.id_proposal
                        left join hibah on proposal.id_hibah = $id"
                );
            $AllProposal = DB::table('hibah')
                ->join('proposal', 'proposal.id_hibah', '=', 'hibah.id')
                ->select('*')
                ->where('proposal.id_hibah', '=', $hibah->id)
                ->get();

            //$AllProposal = Proposal::find($id);

            return view('daftarproposalhibahpengmas', compact('AllProposal','penyesuaianKeuangan'));
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