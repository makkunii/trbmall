<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use DB;
class ApiAccountController extends Controller
{
  //**************************INSERT**************************//
public function insertaccount(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
          // 'name' => 'required|string|max:255',
           'email' => 'required',
           //'email_verified_at' => 'float',
           'role' => 'required',
           'is_active' => 'required',
           'first_name' => 'nullable',
           'last_name' => 'nullable',
           'contact' => 'required',
           'address' => 'required',
           //'scid' => 'required|string|max:255',
           //'remember_token' => 'required',
           'merchant_id' => 'required',
           'created_at' => 'nullable',
           'updated_at' => 'nullable'

       ]);

       // CREATE PRODUCT
       $insert = DB::table('accounts')
       ->insertGetId([
      //'name' => $request->name,
      'email' => $request->email,
      // 'email_verified_at' => $request->email_verified_at,
       'role' => $request->role,
       'is_active' => $request->is_active,
       'first_name' => $request->firs_name,
       'last_name' => $request->last_name,
       'contact' => $request->contact,
       //'scid' => $request->scid,
       //'remember_token' => $request->remember_token,
       'address' => $request->address,
       'merchant_id' => $request->merchant_id,
       'created_at' => $request->created_at,
       'updated_at' => $request->pdated_at

       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Account Created'],200);
   }

  //**************************UPDATE**************************//
   public function updateaccount(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
          // 'name' => 'required|string|max:255',
          'email' => 'required',
          //'email_verified_at' => 'float',
          'role' => 'required',
          'is_active' => 'required',
          'first_name' => 'nullable',
          'last_name' => 'nullable',
          'contact' => 'required',
          'address' => 'required',
          //'scid' => 'required|string|max:255',
          //'remember_token' => 'required',
          'merchant_id' => 'required',
          'created_at' => 'nullable',
          'updated_at' => 'nullable'

          ]);

          // UPDATE PRODUCT
          $update = DB::table('accounts')
          ->where('id', $request->id)
                ->update([
        //'name' => $request->name,
        'email' => $request->email,
       // 'email_verified_at' => $request->email_verified_at,
        'role' => $request->role,
        'is_active' => $request->is_active,
        'first_name' => $request->firs_name,
        'last_name' => $request->last_name,
        'contact' => $request->contact,
        //'scid' => $request->scid,
        //'remember_token' => $request->remember_token,
        'address' => $request->address,
        'merchant_id' => $request->merchant_id,
        'created_at' => $request->created_at,
        'updated_at' => $request->pdated_at
           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Product Updated'],200);
   }


   public function disableaccount(Request $request){
       $request->validate([
           'is_active' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('users')
       ->where('id', $request->id)
       ->update([
           'is_active' => $request->is_active
       ]);
       return response()->json(['Success' => 'Account Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showaccount(){
           $fetchedit = DB::table('users')
           ->select('id','email','role','is_active','first_name','last_name','address','contact','merchant_id','created_at','updated_at')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editaccount($id){
          $fetchedit = DB::table('users')
          ->select('id','email','role','is_active','first_name','last_name','address','contact','merchant_id','created_at','updated_at')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
