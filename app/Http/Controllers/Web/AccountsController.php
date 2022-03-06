<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller
{
    //ACCOUNTS
    public function accounts(Request $request)
    {
        $vaccount = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/accounts'); //call api

        if ($vaccount->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
        {

            $accountdata = $vaccount['Show'];

            // accountdata BELOW IS USED TO TRANSFER $vaccount ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW

            return view('dashboard/accounts')->with(compact('accountdata')); 

        }

        else
        {
            return view('dashboard/dashboard'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }
    }
}
