<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use DB;
class ApiMerchantController extends Controller
{
  //**************************INSERT**************************//
public function insertmerchant(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
           'name' => 'required',
           'description' => 'required',
           'status' => 'required',
           'address' => 'required',
           'contact' => 'required',
           'created_by' => 'required',
           'created_at' => 'required'

       ]);

       // CREATE PRODUCT
       $insert = DB::table('merchant')
       ->insertGetId([
           'name' => $request->name,
           'description' => $request->description,
           'status' => $request->status,
           'address' => $request->address,
           'contact' => $request->contact,
           'created_by' => $request->created_by,
           'created_at' => $request->created_at

       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Merchant Created'],200);
   }

  //**************************UPDATE**************************//
   public function updatemerchant(Request $request){
          // VALIDATE PRODUCT
          $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'created_by' => 'required',
            'created_at' => 'required'
          ]);

          // UPDATE PRODUCT
          $update = DB::table('merchant')
          ->where('id', $request->id)
                ->update([
                    'id' =>$request->id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'created_by' => $request->created_by,
                    'created_at' => $request->created_at


           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Merchant Updated'],200);
   }


   public function disablemerchant(Request $request){
       $request->validate([
           'status' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('merchant')
       ->where('id', $request->id)
       ->update([
           'status' => $request->status
       ]);
       return response()->json(['Success' => 'Merchant Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showmerchant(){
           $fetchedit = DB::table('merchant')
           ->select('id','name','status','address','contact','created_by','created_at')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editmerchant($id){
          $fetchedit = DB::table('merchant')
          ->select('id','name','status','address','contact','created_by','created_at')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }

        //**************************CHECK VIEW**************************//
   public function checkmerchant(){
    $fetchedit = DB::table('merchant')
           ->select('id','name','status','address','contact','created_by','created_at')
           ->get();
           return response()->json(['Check' => $fetchedit], 200);
}
}
