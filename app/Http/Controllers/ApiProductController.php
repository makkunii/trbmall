<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
class ApiProductController extends Controller
{
  //**************************INSERT**************************//
public function insertproduct(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([
        'name' => 'required|string|max:255|unique:products,name',
        'category' => 'nullable',
        'tax' => 'nullable',
        'generic_name' => 'nullable|string|max:255',
        'drug_class' => 'nullable|string|max:255',
        'description' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'measurement' => 'required|string|max:255',
        'is_prescription' => 'required|numeric',
        'is_available' => 'required|numeric',
        'image' => 'mimes:jpg,jpeg,png|max:1096'

       ]);

       // CREATE PRODUCT
       Product::create([
        'name' => $request->input('name'),
        'category_id' => $request->input('category'),
        'tax_id' => $request->input('tax'),
        'generic_name' => $request->input('generic_name'),
        'drug_class' => $request->input('drug_class'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'stock' => $request->input('stock'),
        'measurement' => $request->input('measurement'),
        'is_prescription' => $request->input('is_prescription'),
        'is_available' => $request->input('is_available'),
        'image' => $request->input('is_available'),

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
