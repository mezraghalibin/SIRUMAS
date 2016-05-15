<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FunctionController extends Controller {
	public function getRupiah($angka) {
    //PARSE NOMINAL TO RUPIAH
    $nominal = strval($angka); //INT TO STRING
    $length = strlen($nominal);
    $rupiah = "";
    $counter = 0;
    for ($i = $length-1; $i >= 0; $i--) {
      if ($counter == 3) {
        $rupiah = $nominal[$i] . "." . $rupiah;
        $counter = 0;
      }
      else {
        $rupiah = $nominal[$i] . $rupiah;
      }
      $counter = $counter+1;
    }
    return "Rp. " .  $rupiah . ",-";
  }
}