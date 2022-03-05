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
         //here it request the promo data on the trbexpress api
        $vpromo = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo');

         if ($vpromo->successful())
         {

              $promodata = $vpromo['Show'];

              return view('dashboard/promo')->with(compact('promodata'));

          }

         else
          {
             return view('dashboard/dashboard');
        }
     }

     public function insertpromo(Request $request) {

        $this->validate($request,[
           'name' => 'required',
           'rate' => 'required',
           'is_active' => 'required',
           'created_at' => 'required',
           'expired_at' => 'required'
        ]);

        $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo/insert',[
           'name' => $request->name,
           'rate' => $request->rate,
           'is_active' => $request->is_active,
           'created_at' => $request->created_at,
           'expired_at' => $request->expired_at
        ]);

        if($insert->successful()) {

            return redirect()->back()->with('insertsuccess', 'Promo saved');

        } else {
            return redirect()->back()->with('insertfailed', 'Promo failed to save');
        }
    }



    public function updatepromo(Request $request)
    {

        $this->validate($request,[

           'id' => 'required',
           'name' => 'required',
           'rate' => 'required',
           'is_active' => 'required',
           'created_at' => 'required',
           'expired_at' => 'required'
       ]);

       $id = $request->input('id');

       $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo/update',[

           'id' => $request->id,
           'rate' => $request->rate,
           'is_active' => $request->is_active,
           'created_at' => $request->created_at,
           'expired_at' => $request->expired_at
    ]);

        if ($update->successful())
        {
            return redirect()->back()->with('updatesuccess', 'Promo updated');
        }

        else
        {
            return $update;
            //return redirect()->back()->with('updatefailed', 'Promo failed to update');
        }

    }

} //end
