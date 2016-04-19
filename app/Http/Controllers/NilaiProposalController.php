<?php

namespace App\Http\Controllers;

use App\NilaiProposal;

use App\Borang;

use Illuminate\Support\Facades\Input;

use Session;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class NilaiProposalController extends Controller
{

    public $layout = 'layout.default';
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
            $borangs = DB::table('borang')->get();
            return view('nilaiproposal', ['borangs' => $borangs]);
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
    public function store(Request $request)
    {
        $this->validate($request, [
        'nama_komp' => 'required|max:255',
        'nilai' => 'required',
        'id_proposal' => 'required',
        ]);

        //$nilaiproposal = \App\NilaiProposal::create($request->all());  
        //$nilaiproposal->save();

        
        $komponenString = implode(",", $request->get('nama_komp'));
        /*$nilaiproposal = new NilaiProposal;
        $status = $this->nilaiproposal->create([
        'nilai' => $request->get('nilai'),
        'id_proposal' => $request->get('id_proposal'),
        'staf_riset' => $request->get('staf_riset'),
        'nama_komp' => $komponenString
        ]);
        $status->save();*/

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

    public function getBorang()
    {
         View::share('borangs', DB::table('borang')->get());
        
    }

    protected function setupLayout() {
        if (! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }
}
