<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;

class MouController extends Controller
{
    //
	public function index()
	{
		//CHECK IF USER IS LOGGED IN OR NOT
        $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
        $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
        if($check) {
            return view('mou');
        }
        else {
            return view('login');
        }
	}

    public function upload() {
        
    }
}
