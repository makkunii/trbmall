<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use DB;
class ApiPromoController extends Controller
{
  //**************************INSERT**************************//
public function insertpromo(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
           'name' => 'required|string|max:255',
           'rate' => 'required',
           'is_active' => 'required|integer',
           'created_at' => 'required',
           'expired_at' => 'required'

       ]);

       // CREATE PRODUCT
       $insert = DB::table('promos')
       ->insertGetId([
           'name' => $request->name,
           'rate' => $request->rate,
           'is_active' => $request->is_active,
           'created_at' => $request->created_at,
           'expired_at' => $request->expired_at

       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Promo Created'],200);
   }

  //**************************UPDATE**************************//
   public function updatepromo(Request $request){
          // VALIDATE PRODUCT
          $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'rate' => 'required',
            'is_active' => 'required|integer',
            'created_at' => 'required',
            'expired_at' => 'required'
          ]);

          // UPDATE PRODUCT
          $update = DB::table('promos')
          ->where('id', $request->id)
                ->update([
                    'id' =>$request->id,
                    'name' => $request->name,
                    'rate' => $request->rate,
                    'is_active' => $request->is_active,
                    'created_at' => $request->created_at,
                    'expired_at' => $request->expired_at

           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Promo Updated'],200);
   }


   public function disablepromo(Request $request){
       $request->validate([
           'is_active' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('promos')
       ->where('id', $request->id)
       ->update([
           'is_active' => $request->is_active
       ]);
       return response()->json(['Success' => 'Promo Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showpromo(){
           $fetchedit = DB::table('promos')
           ->select('id','name','rate','is_active','created_at','expired_at')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editpromo($id){
          $fetchedit = DB::table('promos')
          ->select('name','rate','is_active','created_at','expired_at')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }

        //**************************CHECK VIEW**************************//
   public function checkpromo(){
    $fetchedit = DB::table('promos')
           ->select('id','name','rate','is_active','created_at','expired_at')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
}
}
