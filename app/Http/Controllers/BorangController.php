<?php

namespace App\Http\Controllers;

use App\Borang;

use Session;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

class BorangController extends Controller
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
            $borangs= Borang::all();
            return view('borang', ['borangs' => $borangs]);
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
        return view('borang.create');
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
        'komponen' => 'required|unique:borang|max:255',
        ]);

        $input=Input::all();
        $count = count($input['komponen']); // here we will know how many entries have been posted
        $borangsaya = array();
        for($i=0; $i<$count; $i++){
           if(!empty($input['komponen'][$i])){
             array_push($borangsaya, array( // iterate through each entry and create an array of inputs
              'komponen' => $input['komponen'][$i] 
             ));
           }
        }
        Borang::insert($borangsaya); // save the array of models at once
        if (!count($input)) {
        Session::flash('flash_message','isi.');
        } else {
        Session::flash('flash_message','Borang berhasil disimpan.');
        }
        return redirect('borang');
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
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
         $borang= Borang::find($id);
         if(!$borang){ 
         abort(404);
         } else {
         return view('editborang')->with('borang',$borang);
            }

        } else {
            return view('login');
        }
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
         $this->validate($request, [
        'komponen' => 'required|unique:borang|max:255',
        ]);


        $borang= Borang::find($id);
        $borang->komponen = $request->komponen;
        $borang->save(); // save the array of models at once
        Session::flash('flash_message','Borang berhasil diubah.');
        return redirect('borang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borang = Borang::find($id);
        $borang->delete();
        Session::flash('flash_message','Komponen berhasil dihapus.');
        return redirect('borang');
    }
}
