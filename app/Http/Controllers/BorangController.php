<?php

namespace App\Http\Controllers;

use App\Borang;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class BorangController extends Controller {
    public function index() {
        //CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

        if($check) {
            if($route == '/borang/kelolaborang') {
                $borangs= Borang::all();
                return view('/borang/kelolaborang', ['borangs' => $borangs]);
            }
            else if ($route == '/borang/buatborang') {
                return view('/borang/buatborang');
            }
        }
        else {
            return view('login');
        }
    }

    public function create() {
        return view('borang.create');
    }

    public function store(Request $request) {
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
        return redirect('/borang/kelolaborang');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
         $borang= Borang::find($id);
         if(!$borang){ 
         abort(404);
         } else {
         return view('/borang/editborang')->with('borang',$borang);
            }

        } else {
            return view('login');
        }
    }

    public function update(Request $request, $id) {
         $this->validate($request, [
        'komponen' => 'required|unique:borang|max:255',
        ]);

        $borang= Borang::find($id);
        $borang->komponen = $request->komponen;
        $borang->save(); // save the array of models at once
        Session::flash('flash_message','Borang berhasil diubah.');
        return redirect('/borang/kelolaborang');
    }

    public function destroy($id) {
        $borang = Borang::find($id);
        $borang->delete();
        Session::flash('flash_message','Komponen berhasil dihapus.');
        return redirect('/borang/kelolaborang');
    }
}
