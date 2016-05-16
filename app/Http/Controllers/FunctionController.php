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

  public function string_to_date($string) {
    $list = explode(", ", $string);
    $list2 = explode(" ", $list[0]);
    $day = $list2[0];
    $month = "";
    $year = $list[1];
    $monthName = array('January', 'February', 'March', 'April', 'May', "June", 
      'July', 'August', 'September', 'October', 'November', 'December');
    $monthNum = array('1', '2', '3', '4', '5', "6", 
      '7', '8', '9', '10', '11', '12');
    for ($i = 0; $i < 12 ; $i++) { 
      if ($list2[1] == $monthName[$i]) {
        $month = $monthNum[$i];
        break;
      }
    }
    $stringDate = $month . "/" . $day . "/" . $year;
    $time = strtotime($stringDate);
    $date = date('Y-m-d',$time);
    return $date;
  }
}