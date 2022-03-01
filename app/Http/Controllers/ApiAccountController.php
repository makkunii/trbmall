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
           'password' => 'required',
           //'email_verified_at' => 'float',
           'role_id' => 'required',
           'is_active' => 'required',
           'first_name' => 'required',
           'last_name' => 'required',
           'contact' => 'required',
           'address' => 'required',
           //'scid' => 'required|string|max:255',
           //'remember_token' => 'required',
           'merchant_id' => 'required',
           'created_at' => 'nullable',
           'updated_at' => 'nullable'

       ]);

       // CREATE PRODUCT
       $insert = DB::table('users')
       ->insertGetId([
      //'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      // 'email_verified_at' => $request->email_verified_at,
       'role_id' => $request->role_id,
       'is_active' => $request->is_active,
       'first_name' => $request->first_name,
       'last_name' => $request->last_name,
       'contact' => $request->contact,
       //'scid' => $request->scid,
       //'remember_token' => $request->remember_token,
       'address' => $request->address,
       'merchant_id' => $request->merchant_id,
       'created_at' => now(),
       'updated_at' => $request->updated_at

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
          'password' => 'required',
          //'email_verified_at' => 'float',
          'role_id' => 'required',
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
          $update = DB::table('users')
          ->where('id', $request->id)
                ->update([
        //'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
       // 'email_verified_at' => $request->email_verified_at,
        'role_id' => $request->role_id,
        'is_active' => $request->is_active,
        'first_name' => $request->first_name,
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


   public function changepassword(Request $request){
       $request->validate([
           'password' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('users')
       ->where('email', $request->email)
       ->update([
           'password' => $request->password
       ]);
       return response()->json(['Success' => 'Password Changed'],200);

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
