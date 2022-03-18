<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

public function user(Request $request)

{

    if (session()->has('id') && session('role_id') == 0) {
        return view('users/user');
    } else {
        return redirect('login');
    }


}

public function purchase()

{

    if (session()->has('id') && session('role_id') == 0) {
        return view('users/purchase');
    } else {
        return redirect('login');
    }


}


}
