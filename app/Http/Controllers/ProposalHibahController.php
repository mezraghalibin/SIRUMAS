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
        $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

        if($check) {
            $dataHibahRiset = $this->readHibahRiset();
            $dataHibahPengmas = $this->readHibahPengmas();
            $proposalnya = $this->getPenyesuaianKeuangan();
            $penyesuaianKeuangan = DB::select(
                        "SELECT menyesuaikan_keuangan.komentar, proposal.*
                        FROM menyesuaikan_keuangan, proposal
                        WHERE proposal.id IN  
                            (SELECT menyesuaikan_keuangan.id_proposal
                            FROM menyesuaikan_keuangan)"
            );
            if($route == '/proposalriset') {
                $borangs= Borang::all();
                return view('/proposalriset', compact('dataHibahRiset','penyesuaianKeuangan'));
            }
            else if ($route == '/proposalpengmas') {
                return view('/proposalpengmas', compact('dataHibahPengmas','penyesuaianKeuangan'));
            }
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

    public function ubahstatus(Request $request, $id){
        $proposal = Proposal::find($id);
        $proposal->status = $request->status;
        $proposal->save();
        return redirect()->back();
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

    public function readHibahRiset() {
        $dataHibah = Hibah::all();
        return $dataHibah;
    }
    
    public function readHibahPengmas() {
        $dataHibah = Hibah::all();
        return $dataHibah;
    }

    public function getProposalRiset($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        $idHibah = $id; 
        if($check) {
        $allData = $this->getAllData($idHibah);
        $allDataForKeuangan = $this->getAllDataForKeuangan($idHibah);
            return view('/daftarproposalhibahriset', compact('allData', 'allDataForKeuangan'));
        }
        else {
            return view('login');
        }
    }

    public function getProposalPengmas($id) {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        $idHibah = $id; 
        if($check) {
            $allData = $this->getAllData($idHibah);
            $allDataForKeuangan = $this->getAllDataForKeuangan($idHibah);
            return view('/daftarproposalhibahpengmas', compact('allData','allDataForKeuangan'));
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

    public function getAllData($id){
        $allData = DB::select(
                        "SELECT a.id as id_proposal, a.judul_proposal, a.nama_pengaju, a.file, a.status, g.nama_hibah, a.created_at, c.komentar, e.nilai_proposal
                            from proposal as a
                            left join 
                            (
                            select *
                            from menyesuaikan_keuangan as b
                            ) as c on c.id_proposal = a.id 
                            left join
                            (
                            select *
                            from menilai_proposal as d
                            ) as e on e.id_proposal = a.id 
                            left join
                            (
                            select *
                            from hibah as f
                            ) as g on g.id = a.id_hibah 
                            where a.id_hibah = '".$id."'
                        "
                );
        return $allData;
    }

    public function getAllDataForKeuangan($id){
        $allData = DB::select(
                        "SELECT a.id as id_proposal, a.judul_proposal, a.nama_pengaju, a.file, a.status, g.nama_hibah, a.created_at, c.komentar, e.nilai_proposal
                            from proposal as a
                            left join 
                            (
                            select *
                            from menyesuaikan_keuangan as b
                            ) as c on c.id_proposal = a.id 
                            left join
                            (
                            select *
                            from menilai_proposal as d
                            ) as e on e.id_proposal = a.id 
                            left join
                            (
                            select *
                            from hibah as f
                            ) as g on g.id = a.id_hibah 
                            where a.id_hibah = '".$id."' AND a.status = 'Lolos Seleksi'
                        "
                );
        return $allData;
    }
}