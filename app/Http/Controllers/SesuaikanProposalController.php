<?php

namespace App\Http\Controllers;

use Session;
use App\SesuaikanProposal;
use Illuminate\Http\Request;
use App\Http\Requests;

class SesuaikanProposalController extends Controller {
    public function index() {
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

    public function create() {
        //
    }

    public function store(Request $request, $id) {
         $this->validate($request, [
        'komentar' => 'required|max:255',
        ]);

        $sesuaikanproposal = \App\SesuaikanProposal::create($request->all());       
        $sesuaikanproposal->save();
        Session::flash('flash_message','Komentar berhasil dikirim.');
        return redirect('sesuaikanproposal');
    }

    public function storeRiset(Request $request) {
         $this->validate($request, [
        'komentar' => 'required|max:255',
        ]);

        $sesuaikanproposal = \App\SesuaikanProposal::create($request->all());       
        $sesuaikanproposal->save();
        Session::flash('flash_message','Komentar berhasil dikirim.');
        return redirect()->back();
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
