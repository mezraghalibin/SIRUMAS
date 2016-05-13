<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SSOController;
use App\Pengumuman;
use Session;
use DB;

class RepositoryController extends Controller
{
  public function index()
  {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();        
    if($check) {
      if ($route == '/repository') {
        return view('/repository/repository');
      }
    }
    else {
      return view('login');
    }
  }

  public function indexKelolaRepository()
  {
    //CHECK IF USER IS LOGGED IN OR NOT
    $SSOController = new SSOController(); //INISIALISASI CLASS SSOCONTROLLER
    $check = $SSOController->loggedIn(); //SIMPAN NILAI FUNCTION LOGGEDIN();        
    
    $route = $_SERVER['REQUEST_URI']; //GET URL ROUTE

    if($check) {
      if ($route == '/kelolaRepository') {
        return view('repository/kelolaRepository');
      }
    }
    else {
      return view('login');
    }
  }
}
