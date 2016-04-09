<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProposalController extends Controller
{
     public function index()
    {
		return view('proposal');
    }


    public function uploadRevisi()
    {
		return view('proposalupload');
    }
}
