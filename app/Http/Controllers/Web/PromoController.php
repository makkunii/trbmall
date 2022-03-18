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
         if(!session()->has('id') || session('role_id') == 0) {
        return view('login');
    } else {
        $token = $request->cookie('token');
         //here it request the promo data on the trbexpress api
        $vpromo = Http::accept('application/json')->withToken($token)->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo'); //call api

         if ($vpromo->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
         {

              $promodata = $vpromo['Show'];
              // RETURN THIS PAGE IS SUCCESSFUL // promodata BELOW IS USED TO TRANSFER $vpromo ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
              return view('dashboard/promo')->with(compact('promodata'));

          }

         else
          {
             return view('dashboard/dashboard'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }
    }
     }

     public function insertpromo(Request $request) {
        if(!session()->has('id') || session('role_id') == 0) {
            return view('login');
        } else {


        $this->validate($request,[
           'name' => 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
           'rate' => 'required',
           'is_active' => 'required',
           'created_at' => 'required',
           'expired_at' => 'required'
        ]);
        $token = $request->cookie('token');
        
        $insert = Http::accept('application/json')->withToken($token)->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo/insert',[ //call api
           'name' => $request->name, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
           'rate' => $request->rate,
           'is_active' => $request->is_active,
           'created_at' => $request->created_at,
           'expired_at' => $request->expired_at
        ]);

        if($insert->successful()) {

            return redirect()->back()->with('insertsuccess', 'Promo saved'); //redirect to the page and alert will pop up

        } else {
            return redirect()->back()->with('insertfailed', 'Promo failed to save'); //error handling and redirect to the page and alert will pop up
        }
    }
    }



    public function updatepromo(Request $request)
    {
        if(!session()->has('id') || session('role_id') == 0) {
            return view('login');
        } else {


        $this->validate($request,[

           'id' => 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
           'name' => 'required',
           'rate' => 'required',
           'is_active' => 'required',
           'created_at' => 'required',
           'expired_at' => 'required'
       ]);

       $id = $request->input('id'); // CALL ID INPUTFIELD NAME FOR ID(MIGHT BE HIDDEN IF ID ISNT DISPLAYED ON BLADE)
       $token = $request->cookie('token');
       
       $update = Http::accept('application/json')->withToken($token)->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo/update',[ //call api

           'id' => $request->id, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
           'rate' => $request->rate,
           'is_active' => $request->is_active,
           'created_at' => $request->created_at,
           'expired_at' => $request->expired_at
    ]);

        if ($update->successful())
        {
            return redirect()->back()->with('updatesuccess', 'Promo updated'); //redirect to the page and alert will pop up
        }

        else
        {
            return redirect()->back()->with('updatefailed', 'Promo failed to update');  //error handling and redirect to the page and alert will pop up
        }
    }

    }

} //end
