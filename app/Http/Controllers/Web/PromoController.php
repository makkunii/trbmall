<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class PromoController extends Controller
{
     //PROMO
     public function promo(Request $request)
     {
         // $vpromo = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo');
 
         // if ($vpromo->successful())
         // {
 
         //     $promodata = $vpromo['Show'];
 
         //     return view('dashboard/promo')->with(compact('promodata'));
 
         // }
 
         // else
         // {
             return view('dashboard/promo');
     //    }
     }
}
