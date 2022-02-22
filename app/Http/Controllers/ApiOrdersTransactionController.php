<?php

namespace App\Http\Controllers;

use App\Models\Order_Transaction;
use Illuminate\Http\Request;
use DB;
class ApiOrdersTransactionController extends Controller
{
  //**************************INSERT**************************//
public function insertordertransaction(Request $request) {
       // VALIDATE PRODUCT
       $request->validate([

        'product_id'=> 'required',
        'created_at'=> 'required',
        'updated_at'=> 'required',
        'created_by'=> 'required',
        'status'=> 'required'

       ]);
       // CREATE PRODUCT
       $insert = DB::table('order_transactions')
       ->insertGetId([
           'product_id'=> $request->product_id,
           'created_at'=> now(),
           'updated_at'=> $request->updated_at,
           'created_by'=> $request->created_by,
           'status'=>$request->status

       ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Transaction Created'],200);
   }

  //**************************UPDATE**************************//
   public function updateordertransaction(Request $request, $id){
          // VALIDATE PRODUCT
          $request->validate([
            'product_id'=> 'required'. $id,
            'created_at'=> 'required',
            'updated_at'=> 'required',
            'created_by'=> 'required',
            'status'=> 'required'

          ]);

          // UPDATE PRODUCT
          $update = DB::table('order_transactions')
          ->where('id', $request->id)
        ->update([
          'product_id'=> $request->product_id,
          'created_by'=> $request->created_by,
          'created_at'=> $request->created_at,
          'updated_at'=> now(),
          'status'=>$request->status

           ]);

       // REDIRECT TO PRODUCT INDEX
       return response()->json(['Success' => 'Orders Updated'],200);
   }




   //**************************SHOW VIEW**************************//
   public function showordertransaction(){
           $fetchedit = DB::table('order_transactions')
           ->select('id',
        'product_id',
        'created_at',
        'updated_at',
        'created_by',
        'status')
           ->get();
           return response()->json(['Show' => $fetchedit], 200);
       }

  //**************************EDIT VIEW**************************//
  public function editordertransaction($id){
          $fetchedit = DB::table('order_transactions')
          ->select('id',
        'product_id',
        'created_at',
        'updated_at',
        'created_by',
        'status')
          ->where('id',$id)
          ->first();
          return response()->json(['Edit' => $fetchedit], 200);
      }
}
