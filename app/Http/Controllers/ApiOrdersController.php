<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use DB;
class ApiOrdersController extends Controller
{
  //**************************INSERT**************************//
public function insertorder(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([

        'first_name'=> 'required',
        'last_name'=> 'required',
        'province'=> 'required',
        'city'=> 'required',
        'brgy'=> 'required',
        'phone'=> 'required|string|max:20',
        'email'=> 'required|email',
        'promo'=> 'nullable',
        'subtotal'=>'required|numeric|between:0,9999999.99',
        'total'=>'required|numeric|between:0,9999999.99',
        'products'=>'required|string|max:255',
        'quantity'=>'required|numeric|between:0,9999999.99',
        'status'=>'required'
       ]);
       // CREATE PRODUCT
       $insert = DB::table('orders')
       ->insertGetId([
           'first_name'=> $request->first_name,
           'last_name'=> $request->last_name,
           'province'=> $request->province,
           'city'=> $request->city,
           'brgy'=> $request->brgy,
           'phone'=> $request->phone,
           'email'=> $request->email,
           'promo'=> $request->promo,
           'subtotal'=> $request->subtotal,
           'total'=> $request->total,
           'products'=> $request->products,
           'quantity'=> $request->quantity,
           'status'=>$request->status

       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Created'],200);
   }

  //**************************UPDATE**************************//
   public function updateorder(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
            'first_name'=> 'required'. $id,
            'last_name'=> 'required',
            'province'=> 'required',
            'city'=> 'required',
            'brgy'=> 'required',
            'phone'=> 'required',
            'email'=> 'required',
            'promo'=> 'nullable',
            'total'=>'required',
            'products'=>'required',
            'quantity'=>'required',
            'created_at'=> 'nullable',
            'updated_at'=> 'nullable',
            'status'=>'required'
    
          ]);

          // UPDATE PRODUCT
          $update = DB::table('orders')
          ->where('id', $request->id)
        ->update([
          'first_name'=> $request->first_name,
          'last_name'=> $request->last_name,
          'province'=> $request->province,
          'city'=> $request->city,
          'brgy'=> $request->brgy,
          'phone'=> $request->phone,
          'email'=> $request->email,
          'promo'=> $request->promo,
          'total'=> $request->total,
          'products'=> $request->products,
          'quantity'=> $request->quantity,
          'created_at'=> $request->created_at,
          'updated_at'=> now(),
          'status'=>$request->status

           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Updated'],200);
   }


 

   //**************************SHOW VIEW**************************//
   public function showorder(){
           $fetchedit = DB::table('orders')
           ->select('id',
           'first_name',
           'last_name',
           'province',
           'city',
           'brgy',
           'phone',
           'email',
           'subtotal',
           'promo',
           'total',
           'products',
           'quantity',
           'created_at',
           'updated_at',
           'status')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editorder($id){
          $fetchedit = DB::table('orders')
          ->select('first_name',
          'last_name',
          'province',
          'city',
          'brgy',
          'phone',
          'email',
          'promo',
          'total',
          'products',
          'quantity',
          'created_at',
          'updated_at',
          'status')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
