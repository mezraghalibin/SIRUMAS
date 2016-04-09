<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HibahController extends Controller
{
    public function index()
    {
		return view('hibah');
    }

    public function applyHibah()
    {
		return view('applyHibah');
    }

    public function kelolaHibah()
    {
		return view('kelolaHibah');
    }
}
