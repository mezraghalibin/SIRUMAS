<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BorangController extends Controller
{
    public function index()
    {
		return view('borang');
    }
}
