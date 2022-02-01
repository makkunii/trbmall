<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use DB;

class ApiSubCategoryController extends Controller
{
  //**************************INSERT**************************//
public function insertsubcategory(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
        'name' => 'required|string|max:255',
        'is_active' => 'required|integer'

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
   public function updatesubcategory(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'is_active' => 'required|integer'
          ]);

          // UPDATE PRODUCT
          $update = DB::table('category')
          ->where('id', $request->id)
        ->update([
            'id' =>$request->id,
            'name' => $request->name,
            'is_active' => $request->is_active
           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Category Updated'],200);
   }


   public function disablesubcategory(Request $request){
       $request->validate([
           'is_active' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('sub_category')
       ->where('id', $request->id)
       ->update([
           'is_active' => $request->is_active
       ]);
       return response()->json(['Success' => 'SubCategory Disable'],200);

}

   //**************************SHOW VIEW SUB CATEGORY**************************//
   public function showsubcategory(){
           $fetchedit = DB::table('sub_category')
           ->select('id','name','is_active')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

    //**************************SHOW VIEW CATEGORY**************************//
   public function showcategory(){
    $fetchedit = DB::table('category')
    ->select('id','name','is_active')
    ->get();
    return response()->json(['Show' => $fetchedit], 200);
}

  //**************************EDIT VIEW**************************//
  public function editsubcategory($id){
          $fetchedit = DB::table('sub_category')
          ->select('name','is_active')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
