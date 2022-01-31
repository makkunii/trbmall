<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;

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
       $insert = DB::table('category')
       ->insertGetId([
           'name' => $request->name,
           'is_active' => $request->is_active
       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Category Created'],200);
   }

  //**************************UPDATE**************************//
   public function updatecategory(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required'
          ]);

          // UPDATE PRODUCT
          $update = DB::table('category')
          ->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'is_active' => $request->is_active
           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Category Updated'],200);
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
       return response()->json(['Success' => 'Category Updated'],200);

}

   //**************************SHOW VIEW**************************//
   public function showcategory(){
           $fetchedit = DB::table('category')
           ->select('name','is_active')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editcategory($id){
          $fetchedit = DB::table('category')
          ->select('name','is_active')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
