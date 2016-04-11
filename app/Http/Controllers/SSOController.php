<?php

namespace App\Http\Controllers;

use DB;
use App\users; //database users

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
        }
        $userSSO = SSO::getUser();

        //CHECK USER FROM TABLE USERS
        $users = DB::select(
                    DB::raw(
                        "SELECT * 
                        FROM users 
                        WHERE username = '" . $userSSO->username."'"
                    )
                );
        
        //FOR MAHASISWA
        if(count($users) == 0){
            //username is new
            DB::table('users')->insert(
                [
                    'username' => $userSSO->username,
                    'nama' => $userSSO->name, 
                    'no_pengenal' => $userSSO->npm,
                    'role' => $userSSO->role,
                ]
            );                
        }

        //FOR STAFF & DOSEN
        if(count($users) == 0){
            //username is new
            DB::table('users')->insert(
                [
                    'username' => $userSSO->username,
                    'nama' => $userSSO->name, 
                    'no_pengenal' => $userSSO->nip,
                    'role' => $userSSO->role,
                ]
            );                
        }
        return redirect('/');
    }
	
	public function logout()
    {		
    	SSO::logout();
        view ('login');
    }
}
