<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LaporanController extends Controller
{
 
  public function index()
    {
		return view('laporan');
    }   

  public function laporankemajuan(){
    
		return view('laporankemajuan');
  }   

  public function uploadkemajuan(){
    
		return view('uploadkemajuan');
  }   

  public function uploadlaporanberhibah(){
    
		return view('uploadlaporanberhibah');
  }   

public function uploadlaporantdkberhibah(){
    
		return view('uploadlaporantdkberhibah');
  }   

}
