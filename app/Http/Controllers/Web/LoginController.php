<?php

namespace App\Http\Controllers\Web;


use App\Models\Login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\MessageBag;
use DB; 




class LoginController extends Controller

{

    public function login()
    {
        //view login page
        return view('login');
    }

    public function login2(Request $request){

        $credentials = $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($credentials) {
            $login = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/login/'.$credentials['email'].'/'.$credentials['password']);
            if($login->successful()){
                $minutes = 60 * 2;
                $token = $login['token']; // array token but only one value
                $array = $login['account']; // array account
                
                if($array['email'] = $credentials['email'] && $array['is_active'] = 1) // check if email is same and account status is enabled if not enabled cannot login
                {
                    session([
                        'role_id' => $array['role_id'],
                        'id' => $array['id'],
                        'email' => $array['email'],
                        'first_name' => $array['first_name']
                    ]);
                    if($array['role_id'] == 1 ) {
                        return view('dashboard/dashboard');
                    }
                    else if($array['role_id'] == 0 ) {
                        return view('users.user');
                    }
                }

                else
                {
                    return redirect('login')->with('flash_message_error','Account Status is Disabled!');
                }
                
            }
            else
            {
                return redirect('login')->with('flash_message_error','Invalid Username or Password');
            }
        }

    }

} //end