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

          // UPDATE PRODUCT
           Product::where('id', $id)
               ->update([
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
       return redirect()->route('index')->with('message', $request->name . ' has been updated.');
   }


   public function disableproduct(Request $request){
       $request->validate([
           'is_active' => 'required'
       ]); // this is validation for api before update

       //update in database
       $update = DB::table('product')
       ->where('id', $request->id)
       ->update([
           'is_active' => $request->is_active
       ]);
       return response()->json(['Success' => 'Product Disable'],200);

}

   //**************************SHOW VIEW**************************//
   public function showproduct(){
           $fetchedit = DB::table('product')
           ->select( 'name',
           'category_id',
           'tax_id',
           'generic_name',
           'drug_class',
           'description',
           'price',
           'stock',
           'measurement',
           'is_prescription',
           'is_available',
           'is_active',
           'image')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editproduct(){
          $fetchedit = DB::table('product')
          ->select( 'name',
          'category_id',
          'tax_id',
          'generic_name',
          'drug_class',
          'description',
          'price',
          'stock',
          'measurement',
          'is_prescription',
          'is_available',
          'is_active',
          'image')
          ->where('tbl_product',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
