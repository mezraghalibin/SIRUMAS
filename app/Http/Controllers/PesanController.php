<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PesanController extends Controller
{
    public function index()
    {
    	//daftar pesan
		return view('pesan');
    }

}
