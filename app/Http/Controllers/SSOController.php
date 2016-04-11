<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use SSO\SSO;

class SSOController extends Controller
{
    public function index()
    {
     	if (!SSO::check())
        {
            SSO::authenticate();
            $user = SSO::getUser();
        }
    	return view('beranda');
    }
	
	public function logout()
    {		
    	SSO::logout();
    }
}
