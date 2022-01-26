<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard/dashboard');
    }

    public function accounts(){
        return view('dashboard/accounts');
    }



   public function products(Request $request){

    $token = $request->cookie('token');

    $vproduct = Http::accept('application/json')->withToken($token)->get('https://dev.trbmall.trbexpress.net/api/dashboard/products');

    if($vproduct->successful()){

        $productdata = $vproduct['products'];

        return view('dashboard/products')->with(compact('productdata'));

    }

    else{

        return view('dashboard/dashboard');

    }

    }

    public function insertproduct(Request $request){

            $this->validate($request,[

                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'weight' => 'required',
                'length' => 'required',
                'height' => 'required',
                'status'  => 'required'

            ]);

            $token = $request->cookie('token');

            $insert = Http::accept('application/json')->withToken($token)->post('https://dev.trbmall.trbexpress.net/api/dashboard/products/insert',[

                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'weight' => $request->weight,
                'length' => $request->length,
                'height' => $request->height,
                'status' => $request->status

            ]);

            

            if($insert->successful()){

                return redirect()->route('dashboard/products');

            }

            else{

                return redirect()->route('dashboard/dashboard');

            }

    }

    public function updateproduct(Request $request){

            $this->validate($request,[

                 'id' => 'required',
                 'name' => 'required',
                 'description' => 'required',
                 'price' => 'required',
                 'category_id' => 'required',
                 'weight' => 'required',
                 'length' => 'required',
                 'height' => 'required',
                 'status'  => 'required'

            ]); 

            $token = $request->cookie('token');

            $id = $request->input('id');

            if($request){

                $update = Http::accept('application/json')->withToken($token)->post('https://dev.trbmall.trbexpress.net/api/dashboard/products/update',[

                //your data

                'id'=>$request->id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'weight' => $request->weight,
                'length' => $request->length,
                'height' => $request->height,
                'status' => $request->status

                ]);

                if($update->successful()){

                    return redirect()->route('dashboard/products');

                }

                else{

                    return view('dashboard/dashboard');

                }

            }

    }



}
