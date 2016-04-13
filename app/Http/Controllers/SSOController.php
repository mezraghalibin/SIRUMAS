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
<<<<<<< HEAD
        if(count($users) == 0 && $userSSO->role == 'mahasiswa'){
=======
        if(count($userSIRUMAS) == 0 && $userSSO->role == 'mahasiswa'){
>>>>>>> 47fdf249d510d2165e0f9e990032733f4b552846
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
<<<<<<< HEAD
        if(count($users) == 0 $userSSO->role == 'staf'){
=======
        if(count($userSIRUMAS) == 0 && $userSSO->role == 'staff'){
>>>>>>> 47fdf249d510d2165e0f9e990032733f4b552846
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
            $user = get_object_vars($key);
            $_SESSION['username']       = $user['username'];
            $_SESSION['name']           = $user['nama'];
            $_SESSION['role']           = $user['role'];      
            $_SESSION['spesifik_role']  = $user['spesifik_role'];    
        }
        
        $_SESSION['login'] = '1'; //TRUE IF USER HAS LOGGED IN
        return redirect('/'); //REDIRECCT TO HOMEPAGE
    }
	
    //FUNCTION UNTUK MEMBUAT USER LOGOUT DARI SISTEM
	public function logout()
    {		
    	session_destroy(); //REMOVE ALL SESSION
        session_start();
        $_SESSION['login'] = ''; //MAKE LOGIN COUNTER EMPTY
        SSO::logout(); // LOGOUT FROM SSO
        return view ('login'); //REDIRECT TO LOGIN PAGE
    }

    //FUCNTION UNTUK CHECK USER UDAH LOGGEDIN ATAU BELUM
    public function loggedIn() {
        if (isset($_SESSION['login']) && !(empty($_SESSION['login']))) 
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}