<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    public function login($email, $password){
        $account = Login::select('id', 'email', 'password', 'role_id', 'is_active', 'first_name', 'last_name','address','contact','created_at','updated_at','merchant_id')
        -> where('email',$email)
        -> first();

        if(!$account){
            return response()->json(['Error' => 'User not found'], 400);
        }
        else{
            $check = Hash::check($password, $account->password);

            if($check){
                   $token = $account->createToken('login')->plainTextToken;
                 return response()->json([ 
                     'account' => $account->only('id', 'email', 'role_id',  'first_name', 'last_name','address','contact','merchant_id',),
                      'token' =>$token
                ], 200);
            }
            else{
                 return response()->json(['Error' => 'Invalid credentials'], 400);
            }
        }

    }
    

}
