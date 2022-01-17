<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
  //**************************INSERT**************************//
public function insertproduct(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'required',
           'price' => 'float',
           'category' => 'required',
           'sub-category' => 'required',
           'weight' => 'nullable',
           'length' => 'nullable',
           'height' => 'nullable',
           'status' => 'required|string|max:255'

       ]);

       // CREATE PRODUCT
       Product::create([
           'name' => $request->input('name'),
           'description' => $request->input('description'),
           'price' => $request->input('price'),
           'category' => $request->input('category'),
           'sub-category' => $request->input('sub-category'),
           'weight' => $request->input('weight'),
           'length' => $request->input('length'),
           'height' => $request->input('height'),
           'status' => $request->input('status')

       ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been saved.');
   }

  //**************************UPDATE**************************//
   public function updateproduct(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
              'name' => 'required|string|max:255|unique:products,name,'. $id,
              'description' => 'required',
              'price' => 'float',
              'category' => 'required',
              'sub-category' => 'required',
              'weight' => 'nullable',
              'length' => 'nullable',
              'height' => 'nullable',
              'status' => 'required|string|max:255'
          ]);

          // UPDATE PRODUCT
           Product::where('id', $id)
               ->update([
                 'name' => $request->input('name'),
                 'description' => $request->input('description'),
                 'price' => $request->input('price'),
                 'category' => $request->input('category'),
                 'sub-category' => $request->input('sub-category'),
                 'weight' => $request->input('weight'),
                 'length' => $request->input('length'),
                 'height' => $request->input('height'),
                 'status' => $request->input('status')

           ]);

       // REDIRECT TO PRODUCT INDEX
       return redirect()->route('index')->with('message', $request->name . ' has been updated.');
   }


   public function disableproduct(Request $request){
       $request->validate([
           'status' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('tbl_product')
       ->where('id', $request->id)
       ->update([
           'status' => $request->status
       ]);
       return response()->json(['Success' => 'Product Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showproduct(){
           $fetchedit = DB::table('tbl_product')
           ->select('name','description','price','category','sub-category','weight','length','height','status')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editproduct(){
          $fetchedit = DB::table('tbl_product')
          ->select('name','description','price','category','sub-category','weight','length','height','status')
          ->where('tbl_product',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
