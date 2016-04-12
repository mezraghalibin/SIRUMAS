<?php
namespace App\Http\Controllers;

session_start(); // start the session

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

        //CHECK USER FROM TABLE USERS BY SIRUMAS
        $userSIRUMAS = DB::select(
                    DB::raw(
                        "SELECT * 
                        FROM users 
                        WHERE username = '" . $userSSO->username."'"
                    )
                );
        
        //FOR MAHASISWA
        if(count($userSIRUMAS) == 0 && $userSSO->role == 'mahasiswa'){
            //username is new
            DB::table('users')->insert(
                [
                    'username' => $userSSO->username,
                    'nama' => $userSSO->name, 
                    'no_pengenal' => $userSSO->npm,
                    'role' => $userSSO->role,
                    'spesifik_role' => 'mahasiswa',
                ]
            );                
        }

        //FOR STAFF & DOSEN
        if(count($userSIRUMAS) == 0 && $userSSO->role == 'staff'){
            //username is new
            DB::table('users')->insert(
                [
                    'username' => $userSSO->username,
                    'nama' => $userSSO->name, 
                    'no_pengenal' => $userSSO->nip,
                    'role' => $userSSO->role,
                    'spesifik_role' => 'staff',
                ]
            );                
        }

        //GET USER SIRUMAS SPECIFIC ROLE
        foreach ($userSIRUMAS as $key) {
            $parse = get_object_vars($key);
            $_SESSION['role'] = $parse['spesifik_role'];    
            //echo $parse['spesifik_role'];
        }
        
        $_SESSION['login'] = TRUE; //login counter
        return redirect('/');
    }
	
	public function logout()
    {		
    	session_destroy(); //REMOVE ALL SESSION
        session_start();
        $_SESSION['login'] = FALSE;
        SSO::logout(); // LOGOUT FROM SSO
        return view ('login'); //REDIRECT TO LOGIN PAGE
    }

    public function loggedIn() {
        if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
            return true;
        }
        else {
            return false;
        }
    }
}