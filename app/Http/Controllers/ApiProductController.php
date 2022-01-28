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
           'name' => 'required|string|max:255',
           'description' => 'required',
           'price' => 'float',
           'category_id' => 'required',
           'weight' => 'nullable',
           'length' => 'nullable',
           'height' => 'nullable',
           'status' => 'required|string|max:255'
       ]);

       // CREATE PRODUCT
       $insert = DB::table('products')
       ->insertGetId([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'weight' => $request->weight,
        'length' => $request->length,
        'height' => $request->height,
        'status' => $request->status


       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Product Created'],200);
   }

  //**************************UPDATE**************************//
   public function updateproduct(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
            'name' => 'required|string|max:255',
           'description' => 'required',
           'price' => 'float',
           'category_id' => 'required',
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
            'category_id' => $request->input('category_id'),
            'weight' => $request->input('weight'),
            'length' => $request->input('length'),
            'height' => $request->input('height'),
            'status' => $request->input('status')
      ]);


       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Product Updated'],200);
   }


//    public function disableproduct(Request $request){
//        $request->validate([
//            'is_active' => 'required'
//        ]); // this is validation for api before update

//        //update in database
//        $update = DB::table('product')
//        ->where('id', $request->id)
//        ->update([
//            'is_active' => $request->is_active
//        ]);
//        return response()->json(['Success' => 'Product Disable'],200);

// }

   //**************************SHOW VIEW**************************//
   public function showproduct(){
           $fetchedit = DB::table('products')
           ->select( 'id',
           'name',
           'description',
           'price',
           'category_id',
           'weight',
           'length',
           'height',
           'status')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);

           return redirect()->route('index.showproduct')->with('message', $request->name . ' has been updated.');
       }

  //**************************EDIT VIEW**************************//
  public function editproduct($id){
          $fetchedit = DB::table('products')
          ->select( 'name',
          'description',
          'price',
          'category_id',
          'weight',
          'length',
          'height',
          'status')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
