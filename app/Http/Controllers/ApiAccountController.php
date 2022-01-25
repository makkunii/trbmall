<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class ApiAccountController extends Controller
{
  //**************************INSERT**************************//
public function insertaccount(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required',
           'email_verified_at' => 'float',
           'is_admin' => 'required',
           'is_active' => 'required',
           'firs_name' => 'nullable',
           'last_name' => 'nullable',
           'contact' => 'nullable',
           'scid' => 'required|string|max:255',
           'remember_token' => 'required',
           'created_at' => 'nullable',
           'updated_at' => 'nullable'

       ]);

       // CREATE PRODUCT
       Product::create([
           'name' => $request->input('name'),
           'email' => $request->input('email'),
           'email_verified_at' => $request->input('email_verified_at'),
           'is_admin' => $request->input('is_admin'),
           'is_active' => $request->input('is_active'),
           'firs_name' => $request->input('firs_name'),
           'last_name' => $request->input('last_name'),
           'contact' => $request->input('contact'),
           'scid' => $request->input('scid'),
           'remember_token' => $request->input('remember_token'),
           'created_at' => $request->input('created_at'),
           'updated_at' => $request->input('updated_at')

       ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been saved.');
   }

  //**************************UPDATE**************************//
   public function updateaccount(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
              'name' => 'required|string|max:255|unique:products,name,'. $id,
              'email' => 'required',
              'email_verified_at' => 'float',
              'is_admin' => 'required',
              'is_active' => 'required',
              'firs_name' => 'nullable',
              'last_name' => 'nullable',
              'contact' => 'nullable',
              'scid' => 'required|string|max:255',
              'remember_token' => 'required',
              'created_at' => 'nullable',
              'updated_at' => 'nullable'
          ]);

          // UPDATE PRODUCT
           Product::where('id', $id)
               ->update([
                 'name' => $request->input('name'),
                 'email' => $request->input('email'),
                 'email_verified_at' => $request->input('email_verified_at'),
                 'is_admin' => $request->input('is_admin'),
                 'is_active' => $request->input('is_active'),
                 'firs_name' => $request->input('firs_name'),
                 'last_name' => $request->input('last_name'),
                 'contact' => $request->input('contact'),
                 'scid' => $request->input('scid'),
                 'remember_token' => $request->input('remember_token'),
                 'created_at' => $request->input('created_at'),
                 'updated_at' => $request->input('updated_at')

           ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been updated.');
   }


   public function disableaccount(Request $request){
       $request->validate([
           'is_active' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('accounts')
       ->where('id', $request->id)
       ->update([
           'is_active' => $request->is_active
       ]);
       return response()->json(['Success' => 'Account Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showaccount(){
           $fetchedit = DB::table('accounts')
           ->select('name','email','email_verified_at','password','is_admin','is_active','firs_name','last_name','address','contact','scid')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editaccount($id){
          $fetchedit = DB::table('accounts')
          ->select('name','email','email_verified_at','password','is_admin','is_active','firs_name','last_name','address','contact','scid')
          ->where('accounts',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
