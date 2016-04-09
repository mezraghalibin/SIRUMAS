<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PengumumanController extends Controller
{
    public function index()
    {
		return view('pengumuman');
    }

    public function kelola()
    {
		return view('kelolapengumuman');
    }

}
