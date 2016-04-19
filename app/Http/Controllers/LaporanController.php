<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\SSOController;

class LaporanController extends Controller
{
 
  public function index()
  {
		//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        return view('laporan');
    }
    else {
        return view('login');
    }
  }   

  public function laporankemajuan()
  {  
		//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        return view('laporankemajuan');
    }
    else {
        return view('login');
    }
  }   

  public function uploadkemajuan()
  {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        return view('uploadkemajuan');
    }
    else {
        return view('login');
    }
  }   

  public function uploadlaporanberhibah()
  {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        return view('uploadlaporanberhibah');
    }
    else {
        return view('login');
    }
  }   

public function uploadlaporantdkberhibah()
{
		//CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();
    if($check) {
        return view('uploadlaporantdkberhibah');
    }
    else {
        return view('login');
    }
  }   

}
