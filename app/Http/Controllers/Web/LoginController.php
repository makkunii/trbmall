<?php

namespace App\Http\Controllers\Web;


use App\Models\Otp;
use App\Models\User;
use App\Models\UserRole;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;



class LoginController extends Controller

{

    public function login($id, $password){

        $credentials = $this->validate($request, [
            'id' => 'required',
            'password' => 'required'
        ]);

        if($credentials) {
            $login = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/login/'.$credentials['id'].'/'.$credentials['password']);
            if($login->successful()){
                $minutes = 60 * 2;
                $token = $login['token']; // array token but only one value
                $array = $login['account']; // array account
                
                if($array['id'] = $credentials['id'] && $array['status'] = 1) // check if id is same and account status is enabled if not enabled cannot login
                {
                    session([
                        'role_id' => $array['role_id'],
                        'id' => $array['id'],
                        'first_name' => $array['first_name'],
                        'email' => $array['email']
                    ]);
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

