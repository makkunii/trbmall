<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;


class LogoutController extends Controller
{
    public function logout(Request $request)
    {       
        $request->session()->flush();
        $request->session()->regenerate();
        Auth::logout();
        
        return redirect('https://dev.trbmall.trbexpressinc.net/');
        
    }
}