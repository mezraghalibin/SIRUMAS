<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProposalHibahController extends Controller
{
     public function index()
    {
		return view('proposalhibah');
    }

     public function nilaiProposal()
    {
		return view('nilaiproposal');
    }

    public function sesuaikanProposal()
    {
		return view('sesuaikanproposal');
    }
}
