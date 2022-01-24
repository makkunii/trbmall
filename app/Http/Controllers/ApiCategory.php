<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
  //**************************INSERT**************************//
public function insertcategory(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
           'name' => 'required|string|max:255',
           'is_active' => 'required'

       ]);

       // CREATE PRODUCT
       Product::create([
           'name' => $request->input('name'),
           'is_active' => $request->input('is_active')
       ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been saved.');
   }

  //**************************UPDATE**************************//
   public function updatecategory(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required'
          ]);

          // UPDATE PRODUCT
           Product::where('id', $id)
               ->update([
                 'name' => $request->input('name'),
                 'is_active' => $request->input('is_active')
           ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been updated.');
   }


   public function disablecategory(Request $request){
       $request->validate([
           'is_active' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('category')
       ->where('id', $request->id)
       ->update([
           'is_active' => $request->is_active
       ]);
       return response()->json(['Success' => 'Account Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showcategory(){
           $fetchedit = DB::table('category')
           ->select('name','is_active')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editcate(){
          $fetchedit = DB::table('category')
          ->select('name','is_active')
          ->where('accounts',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
