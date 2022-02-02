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
        $vaccount = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/accounts');

        if ($vaccount->successful())
        {

            $accountdata = $vaccount['Show'];

            return view('dashboard/accounts')->with(compact('accountdata'));

        }

        else
        {
            return view('dashboard/dashboard');
        }
    }
}
