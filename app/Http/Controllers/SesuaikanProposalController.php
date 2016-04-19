<?php

namespace App\Http\Controllers;

use Session;

use App\SesuaikanProposal;

use Illuminate\Http\Request;

use App\Http\Requests;

class SesuaikanProposalController extends Controller
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
            return view('sesuaikanproposal');
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
    public function store(Request $request, $id)
    {
         $this->validate($request, [
        'komentar' => 'required|max:255',
        ]);

        $sesuaikanproposal = \App\SesuaikanProposal::create($request->all());       
        $sesuaikanproposal->save();
        Session::flash('flash_message','Komentar berhasil dikirim.');
        return redirect('sesuaikanproposal');
    }

  public function storeRiset(Request $request)
    {
         $this->validate($request, [
        'komentar' => 'required|max:255',
        ]);

        $sesuaikanproposal = \App\SesuaikanProposal::create($request->all());       
        $sesuaikanproposal->save();
        Session::flash('flash_message','Komentar berhasil dikirim.');
        return redirect()->back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
